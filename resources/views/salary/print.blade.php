<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>薪資單列印</title>
    <style>
        @page {
            size: 100mm auto;
            margin: 6mm;
        }

        * {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            color: #000;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .salary-card {
            width: 100%;
            page-break-after: always;
        }

        .salary-card:last-child {
            page-break-after: avoid;
        }

        .divider {
            border-top: 1px dashed #000;
            margin: 4px 0;
        }

        .row {
            display: flex;
            justify-content: space-between;
            padding: 2px 0;
            gap: 8px;
        }

        .label {
            color: #333;
        }

        .total-row {
            font-size: 14px;
            font-weight: bold;
            padding: 4px 0;
        }

        .section-title {
            font-weight: bold;
            margin: 4px 0 2px 0;
        }

        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="padding: 16px; background: #f5f5f5;">
        <p>共 {{ count($records) }} 張薪資單</p>
        <button onclick="window.print()">🖨️ 列印</button>
        <button onclick="window.close()">✕ 關閉</button>
    </div>

    @foreach($records as $record)
    <div class="salary-card">
        <div style="text-align:center; font-size:13px; font-weight:bold;">
            {{ $company }}
        </div>
        <div style="text-align:center;">
            {{ $record->year }} 年 {{ $record->month }} 月 薪資明細
        </div>

        <div class="divider"></div>

        <div class="row">
            <span class="label">員工姓名</span>
            <span>{{ $record->employee->name }}</span>
        </div>
        <div class="row">
            <span class="label">到職日期</span>
            <span>{{ optional($record->employee->hired_date)->format('Y/m/d') ?: '-' }}</span>
        </div>

        <div class="divider"></div>

        <div class="section-title">薪資項目</div>
        <div class="row">
            <span class="label">基本月薪</span>
            <span>$ {{ number_format(round($record->base_salary)) }}</span>
        </div>

        @if($record->leave_deduction > 0)
        <div class="row">
            <span class="label">
                請假扣薪
                @if($show_hours)
                    （{{ $record->leave_hours }}小時）
                @endif
            </span>
            <span>- $ {{ number_format(round($record->leave_deduction)) }}</span>
        </div>
        @endif

        @if($record->overtime_pay > 0)
        <div class="row">
            <span class="label">
                加班費
                @if($show_hours)
                    （1.34倍 {{ $record->overtime_hours_134 }}h + 1.67倍 {{ $record->overtime_hours_167 }}h）
                @endif
            </span>
            <span>+ $ {{ number_format(round($record->overtime_pay)) }}</span>
        </div>
        @endif

        @if($record->additions->count() > 0)
        <div class="divider"></div>
        <div class="section-title">加項</div>
        @foreach($record->additions as $addition)
        <div class="row">
            <span class="label">
                {{ $addition->name }}
                @if($addition->unit_price && $addition->quantity)
                    （{{ (int) $addition->quantity }}天 × ${{ number_format($addition->unit_price) }}）
                @endif
            </span>
            <span>+ $ {{ number_format(round($addition->amount)) }}</span>
        </div>
        @endforeach
        @endif

        @if($record->deductions->count() > 0)
        <div class="divider"></div>
        <div class="section-title">減項</div>
        @foreach($record->deductions as $deduction)
        <div class="row">
            <span class="label">{{ $deduction->name }}</span>
            <span>- $ {{ number_format(round($deduction->amount)) }}</span>
        </div>
        @endforeach
        @endif

        <div class="divider"></div>
        <div class="section-title">勞健保</div>
        <div class="row">
            <span class="label">勞保自付額</span>
            <span>- $ {{ number_format($record->labor_insurance_amount) }}</span>
        </div>
        <div class="row">
            <span class="label">
                健保自付額
                @if($record->health_insurance_dependents > 0)
                    （本人+{{ $record->health_insurance_dependents }}）
                @endif
            </span>
            <span>- $ {{ number_format($record->health_insurance_amount) }}</span>
        </div>

        <div class="divider"></div>
        <div class="row total-row">
            <span>實領薪資（核發）</span>
            <span>$ {{ number_format(round($record->net_salary)) }}</span>
        </div>

        @php
            $bank = optional($record->employee->bankAccounts)->first();
            $account = (string) optional($bank)->account_number;
            $maskedAccount = $account !== ''
                ? str_repeat('x', max(strlen($account) - 4, 0)) . substr($account, -4)
                : '-';
        @endphp
        @if($show_bank && $bank)
        <div class="divider"></div>
        <div class="row">
            <span class="label">銀行名稱</span>
            <span>{{ $bank->bank_name }}</span>
        </div>
        <div class="row">
            <span class="label">銀行代碼</span>
            <span>{{ $bank->bank_code }}</span>
        </div>
        <div class="row">
            <span class="label">帳號</span>
            <span>{{ $maskedAccount }}</span>
        </div>
        @endif
    </div>
    @endforeach
</body>
</html>
