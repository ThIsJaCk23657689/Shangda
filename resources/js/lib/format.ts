const numberFormatter = new Intl.NumberFormat('zh-TW', {
    maximumFractionDigits: 2,
});

const currencyFormatter = new Intl.NumberFormat('zh-TW', {
    style: 'currency',
    currency: 'TWD',
    maximumFractionDigits: 0,
});

export const formatNumber = (value: number | string | null | undefined): string =>
    numberFormatter.format(Number(value ?? 0));

export const formatCurrency = (value: number | string | null | undefined): string =>
    currencyFormatter.format(Number(value ?? 0));

export const formatPercent = (value: number | null | undefined): string =>
    value === null || value === undefined
        ? '—'
        : `${numberFormatter.format(Math.abs(value))}%`;
