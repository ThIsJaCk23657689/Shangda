<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Product;
use App\Tag;

class AutoTagProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:auto-tag {--dry-run : 僅顯示結果，不實際執行}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '自動從商品名稱中提取尺寸資訊並建立標籤';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        if ($dryRun) {
            $this->info('=== 預覽模式（不會實際執行） ===');
        }

        // 取得所有商品
        $products = Product::all();
        $this->info("找到 {$products->count()} 個商品");

        $taggedCount = 0;
        $noWeightCount = 0;
        $tagStats = [];

        foreach ($products as $product) {
            // 從商品名稱中提取重量資訊
            $weights = $this->extractWeights($product->name);
            
            if (!empty($weights)) {
                $taggedCount++;
                
                if (!$dryRun) {
                    // 為每個尺寸建立或取得標籤
                    foreach ($weights as $weight) {
                        $tag = Tag::firstOrCreate(['name' => $weight]);
                        
                        // 將標籤關聯到商品（如果尚未關聯）
                        if (!$product->tags()->where('tag_id', $tag->id)->exists()) {
                            $product->tags()->attach($tag->id);
                        }
                        
                        // 統計標籤使用次數
                        if (!isset($tagStats[$weight])) {
                            $tagStats[$weight] = 0;
                        }
                        $tagStats[$weight]++;
                    }
                } else {
                    // 預覽模式：只顯示統計
                    foreach ($weights as $weight) {
                        if (!isset($tagStats[$weight])) {
                            $tagStats[$weight] = 0;
                        }
                        $tagStats[$weight]++;
                    }
                    $this->line("商品 #{$product->id} ({$product->name}): " . implode(', ', $weights));
                }
            }
            else {
                if ($dryRun) {
                    $this->question("商品 #{$product->id} ({$product->name}): 無尺寸資訊");
                }
                $noWeightCount++;
            }
        }

        $this->info("\n=== 處理結果 ===");
        $this->info("已處理商品數: {$taggedCount}");
        $this->info("無重量資訊商品數: {$noWeightCount}");
        $this->info("發現的重量標籤:");

        foreach ($tagStats as $weight => $count) {
            $this->line("  - {$weight}: {$count} 個商品");
        }

        if ($dryRun) {
            $this->warn("\n這是預覽模式，實際執行請移除 --dry-run 參數");
        } else {
            $this->info("\n標籤建立完成！");
        }

        return 0;
    }

    /**
     * 從商品名稱中提取尺寸資訊
     * 支援格式：(8), (10), (10.5), (11), (12) 等，單位是台兩
     *
     * @param string $productName
     * @return array
     */
    private function extractWeights($productName)
    {
        $weights = [];
        
        // 使用正則表達式匹配括號內的數字（支援小數）
        // 匹配格式：(8), (10), (10.5), (11), (12) 等
        preg_match_all('/\((\d+(?:\.\d+)?)\)/', $productName, $matches);
        
        if (!empty($matches[1])) {
            foreach ($matches[1] as $weight) {
                // 將尺寸格式化為統一格式，例如：8, 10, 10.5
                $formattedWeight = '重量 ' . $weight;
                if (!in_array($formattedWeight, $weights)) {
                    $weights[] = $formattedWeight;
                }
            }
        }
        
        return $weights;
    }
}
