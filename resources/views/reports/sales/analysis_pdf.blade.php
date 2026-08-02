<!doctype html>
<html lang="zh-Hant">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 24px; }
        body { font-family: "Noto Sans TC", "DejaVu Sans", sans-serif; font-size: 9px; color: #222; }
        h1 { font-size: 18px; margin: 0 0 6px; }
        .meta { color: #666; margin-bottom: 10px; }
        .chart { text-align: center; margin: 8px 0 12px; }
        .chart img { max-width: 760px; max-height: 260px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #888; padding: 3px 4px; }
        th { background: #e9ecef; }
        td:not(:first-child) { text-align: right; }
        tr { page-break-inside: avoid; }
    </style>
</head>
<body>
    <h1>{{ $title }}</h1>
    <div class="meta">產生時間：{{ $generatedAt->format('Y-m-d H:i:s') }}　金額口徑：{{ ($filters['amount_basis'] ?? 'pre_tax') === 'tax_inclusive' ? '含稅' : '未稅' }}</div>
    @if($chartImage)
        <div class="chart"><img src="{{ $chartImage }}" alt="銷售圖表"></div>
    @endif
    <table>
        <thead><tr>@foreach($headers as $header)<th>{{ $header }}</th>@endforeach</tr></thead>
        <tbody>
        @forelse($rows as $row)
            <tr>@foreach($row as $value)<td>{{ is_numeric($value) ? number_format((float) $value, 2) : $value }}</td>@endforeach</tr>
        @empty
            <tr><td colspan="{{ count($headers) }}" style="text-align:center">查無資料</td></tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>
