<!doctype html>
<html lang="zh-Hant">
<head>
    <meta charset="utf-8">
    <style>
        @page { margin: 14mm 13mm 16mm; }
        body { font-family: "Noto Sans TC", "DejaVu Sans", sans-serif; font-size: 12pt; line-height: 1.45; color: #202124; }
        h1 { font-size: 20pt; font-weight: bold; margin: 0 0 4mm; color: #1f3b64; }
        h2 { font-size: 14pt; font-weight: bold; margin: 7mm 0 3mm; color: #1f3b64; }
        .meta { padding: 3mm 4mm; margin-bottom: 5mm; background: #f3f6fa; border-left: 3px solid #4e73df; color: #3f4854; }
        .meta-line { margin: 0 0 1.2mm; }
        .meta-line:last-child { margin-bottom: 0; }
        .chart { text-align: center; margin: 4mm 0 7mm; page-break-inside: avoid; }
        .chart img { max-width: 178mm; max-height: 82mm; }
        table { width: 100%; border-collapse: collapse; }
        thead { display: table-header-group; }
        th, td { border: 1px solid #8b95a3; padding: 2.6mm 2.8mm; vertical-align: middle; }
        th { background: #e7edf5; font-size: 12.5pt; font-weight: bold; color: #26384d; }
        tbody tr:nth-child(even) { background: #fafbfd; }
        tr { page-break-inside: avoid; }
        .text { text-align: left; overflow-wrap: break-word; word-wrap: break-word; }
        .number { text-align: right; white-space: nowrap; }
        .empty { padding: 9mm; text-align: center; color: #6c757d; }
        .overview-section { page-break-before: always; }
        .overview-section.first { page-break-before: auto; }
        .period-heading { margin-bottom: 2.5mm; font-size: 12pt; color: #596579; }
        .summary { margin-bottom: 5mm; page-break-inside: avoid; }
        .summary td { width: 25%; background: #f7f9fc; }
        .summary .value { font-weight: bold; text-align: right; }
        .detail-card { margin-bottom: 5mm; border: 1.5px solid #6f7d90; page-break-inside: avoid; }
        .detail-card .card-title { padding: 2.8mm 3.5mm; background: #dfe8f4; font-weight: bold; color: #203754; }
        .detail-card table { border: 0; }
        .detail-card th { width: 18%; background: #f0f3f7; font-size: 11.5pt; white-space: nowrap; }
        .detail-card td { width: 32%; }
        .detail-card th, .detail-card td { border-width: 1px 0 0 1px; }
        .detail-card tr > :first-child { border-left: 0; }
        .footer { position: fixed; bottom: -11mm; left: 0; right: 0; text-align: center; font-size: 9.5pt; color: #7b8491; }
    </style>
</head>
<body>
    <div class="footer">尚達銷售分析報表</div>
    <h1>{{ $title }}</h1>
    <div class="meta">
        <div class="meta-line"><strong>分析期間：</strong>{{ $periodLabel ?? '未指定' }}</div>
        <div class="meta-line"><strong>篩選條件：</strong>{{ implode('　', $filterSummary ?? []) }}</div>
        <div class="meta-line"><strong>產生時間：</strong>{{ $generatedAt->timezone('Asia/Taipei')->format('Y-m-d H:i:s') }}</div>
    </div>

    @if($chartImage)
        <div class="chart"><img src="{{ $chartImage }}" alt="銷售圖表"></div>
    @endif

    @if(($tab ?? 'drilldown') === 'overview')
        @forelse($sections ?? [] as $sectionIndex => $section)
            <div class="overview-section {{ $sectionIndex === 0 && !$chartImage ? 'first' : '' }}">
                <h2>月份區段：{{ $section['months'][0] }} 月至 {{ $section['months'][count($section['months']) - 1] }} 月</h2>
                <table>
                    <thead><tr>@foreach($section['headers'] as $header)<th>{{ $header }}</th>@endforeach</tr></thead>
                    <tbody>
                    @forelse($section['rows'] as $row)
                        <tr>@foreach($row as $index => $value)<td class="{{ $index === 0 ? 'text' : 'number' }}">{{ $index === 0 ? $value : number_format((float) $value, 2) }}</td>@endforeach</tr>
                    @empty
                        <tr><td colspan="{{ count($section['headers']) }}" class="empty">查無資料</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        @empty
            <div class="empty">查無資料</div>
        @endforelse
    @elseif(($tab ?? 'drilldown') === 'detail')
        @if($summary ?? null)
            <table class="summary"><tr><td>明細筆數</td><td class="value">{{ number_format($summary['row_count']) }}</td><td>銷貨單數</td><td class="value">{{ number_format($summary['order_count']) }}</td></tr><tr><td>總數量</td><td class="value">{{ number_format((float) $summary['quantity'], 2) }}</td><td>總金額</td><td class="value">{{ number_format((float) $summary['amount'], 2) }}</td></tr></table>
        @endif
        @forelse($rows as $row)
            <div class="detail-card">
                <div class="card-title">銷貨單號：{{ $row[0] }}　｜　{{ $row[2] }}</div>
                <table>
                    <tr><th>日期</th><td>{{ $row[1] }}</td><th>顧客</th><td class="text">{{ $row[3] }}</td></tr>
                    <tr><th>商品編號</th><td class="text">{{ $row[4] }}</td><th>商品</th><td class="text">{{ $row[5] }}</td></tr>
                    <tr><th>單位</th><td>{{ $row[6] }}</td><th>數量</th><td class="number">{{ number_format((float) $row[7], 2) }}</td></tr>
                    <tr><th>單價</th><td class="number">{{ number_format((float) $row[8], 2) }}</td><th>折數</th><td class="number">{{ number_format((float) $row[9], 2) }}</td></tr>
                    <tr><th>金額</th><td class="number" colspan="3"><strong>{{ number_format((float) $row[10], 2) }}</strong></td></tr>
                </table>
            </div>
        @empty
            <div class="empty">查無資料</div>
        @endforelse
    @else
        <table>
            <thead><tr>@foreach($headers as $header)<th>{{ $header }}</th>@endforeach</tr></thead>
            <tbody>
            @forelse($rows as $row)
                <tr>@foreach($row as $index => $value)<td class="{{ $index === 0 ? 'text' : 'number' }}">{{ $index === 0 || !is_numeric($value) ? $value : number_format((float) $value, 2) }}</td>@endforeach</tr>
            @empty
                <tr><td colspan="{{ count($headers) }}" class="empty">查無資料</td></tr>
            @endforelse
            </tbody>
        </table>
    @endif
</body>
</html>
