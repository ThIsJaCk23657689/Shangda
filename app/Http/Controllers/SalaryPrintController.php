<?php

namespace App\Http\Controllers;

use App\Employee\EmployeeSalaryRecord;
use Illuminate\Http\Request;

class SalaryPrintController extends Controller
{
    public function show(Request $request, int $id)
    {
        $record = EmployeeSalaryRecord::query()
            ->with([
                'employee.bankAccounts' => function ($query) {
                    $query->where('is_primary', 1);
                },
                'additions',
                'deductions',
            ])
            ->find($id);

        if (!$record) {
            abort(404);
        }

        if ((int) $record->status !== EmployeeSalaryRecord::STATUS_CONFIRMED) {
            abort(403, '僅已確認的薪資單可列印');
        }

        return view('salary.print', [
            'records' => collect([$record]),
            'show_bank' => $this->parseBoolQuery($request->query('show_bank', 0)),
            'show_hours' => $this->parseBoolQuery($request->query('show_hours', 0)),
            'company' => "尚達塑膠有限公司",
        ]);
    }

    public function batch(Request $request)
    {
        $idsString = (string) $request->query('ids', '');
        $ids = collect(explode(',', $idsString))
            ->map(function ($id) {
                return trim($id);
            })
            ->filter(function ($id) {
                return $id !== '' && ctype_digit($id);
            })
            ->map(function ($id) {
                return (int) $id;
            })
            ->unique()
            ->values();

        if ($ids->isEmpty()) {
            abort(422, 'ids 參數格式錯誤或為空');
        }

        $existingCount = EmployeeSalaryRecord::query()
            ->whereIn('id', $ids->all())
            ->count();

        if ($existingCount !== $ids->count()) {
            abort(422, 'ids 包含不存在的薪資單');
        }

        $records = EmployeeSalaryRecord::query()
            ->with([
                'employee.bankAccounts' => function ($query) {
                    $query->where('is_primary', 1);
                },
                'additions',
                'deductions',
            ])
            ->whereIn('id', $ids->all())
            ->where('status', EmployeeSalaryRecord::STATUS_CONFIRMED)
            ->get()
            ->sortBy(function (EmployeeSalaryRecord $record) use ($ids) {
                return $ids->search((int) $record->id);
            })
            ->values();

        if ($records->isEmpty()) {
            abort(403, '沒有可列印的已確認薪資單');
        }

        return view('salary.print', [
            'records' => $records,
            'show_bank' => $this->parseBoolQuery($request->query('show_bank', 0)),
            'show_hours' => $this->parseBoolQuery($request->query('show_hours', 0)),
            'company' => "尚達塑膠有限公司",
        ]);
    }

    protected function parseBoolQuery($value): bool
    {
        return in_array((string) $value, ['1', 'true', 'on'], true);
    }
}
