<?php

namespace App\Services;

use Illuminate\Support\Facades\File;

class InsuranceService
{
    /**
     * 根據經常性薪資查表，回傳勞健保金額
     *
     * @return array ['labor' => int, 'health' => int]
     */
    public static function lookup(float $regularWage, int $dependents): array
    {
        $decoded = json_decode(
            File::get(base_path('config/insurance_tables.json')),
            true
        );

        $tables = collect($decoded['tables'] ?? []);
        if ($tables->isEmpty()) {
            return ['labor' => 0, 'health' => 0];
        }

        $matched = $tables->first(function ($row) use ($regularWage) {
            return $regularWage >= (float) ($row['salary_min'] ?? 0)
                && $regularWage <= (float) ($row['salary_max'] ?? 0);
        });

        if (!$matched) {
            // 超過最高級距，取最後一筆
            $matched = $tables->last();
        }

        $labor = (int) ($matched['labor'] ?? 0);
        $healthBase = (int) ($matched['health'] ?? 0);

        return [
            'labor' => $labor,
            'health' => $healthBase * ($dependents + 1),
        ];
    }
}
