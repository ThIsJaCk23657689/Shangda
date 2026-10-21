<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use FilesystemIterator;

class AuditStorage extends Command
{
    protected $signature = 'storage:audit
        {path=storage/app/public : Directory to inventory}
        {--manifest= : Compare against an existing JSON manifest}
        {--write-manifest= : Write the current inventory to a JSON manifest}';

    protected $description = 'Inventory persistent uploads by relative path, byte size, and SHA-256 hash';

    public function handle(): int
    {
        $root = realpath(base_path((string) $this->argument('path')))
            ?: realpath((string) $this->argument('path'));

        if (! $root || ! is_dir($root)) {
            $this->error('Storage directory does not exist.');
            return self::FAILURE;
        }

        $files = [];
        $bytes = 0;
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(
            $root,
            FilesystemIterator::SKIP_DOTS,
        ));

        foreach ($iterator as $file) {
            if (! $file->isFile()) {
                continue;
            }

            $relative = str_replace('\\', '/', substr($file->getPathname(), strlen($root) + 1));
            $size = $file->getSize();
            $files[$relative] = ['size' => $size, 'sha256' => hash_file('sha256', $file->getPathname())];
            $bytes += $size;
        }

        ksort($files);
        $inventory = [
            'version' => 1,
            'root' => str_replace('\\', '/', $root),
            'file_count' => count($files),
            'total_bytes' => $bytes,
            'files' => $files,
        ];

        if ($target = $this->option('write-manifest')) {
            $json = json_encode($inventory, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR);
            file_put_contents((string) $target, $json.PHP_EOL);
            $this->info("Manifest written to {$target}");
        }

        if ($manifest = $this->option('manifest')) {
            if (! is_file((string) $manifest)) {
                $this->error("Manifest not found: {$manifest}");
                return self::FAILURE;
            }

            $expected = json_decode(file_get_contents((string) $manifest), true, flags: JSON_THROW_ON_ERROR);
            $expectedFiles = $expected['files'] ?? [];
            $missing = array_diff_key($expectedFiles, $files);
            $unexpected = array_diff_key($files, $expectedFiles);
            $changed = array_filter(
                array_intersect_key($files, $expectedFiles),
                fn (array $actual, string $path): bool => $actual !== $expectedFiles[$path],
                ARRAY_FILTER_USE_BOTH,
            );

            if ($missing || $unexpected || $changed) {
                $this->error(sprintf(
                    'Storage mismatch: %d missing, %d changed, %d unexpected.',
                    count($missing),
                    count($changed),
                    count($unexpected),
                ));
                return self::FAILURE;
            }
        }

        $this->table(['Files', 'Bytes', 'Aggregate SHA-256'], [[
            count($files),
            $bytes,
            hash('sha256', json_encode($files, JSON_UNESCAPED_SLASHES | JSON_THROW_ON_ERROR)),
        ]]);

        return self::SUCCESS;
    }
}
