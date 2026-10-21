import { describe, expect, it } from 'vitest';
import { formatCurrency, formatNumber, formatPercent } from './format';

describe('Traditional Chinese business formatters', () => {
    it('formats numbers and New Taiwan dollars consistently', () => {
        expect(formatNumber(1234.5)).toBe('1,234.5');
        expect(formatCurrency(1234)).toContain('1,234');
    });

    it('uses an em dash for an unavailable percentage', () => {
        expect(formatPercent(null)).toBe('—');
        expect(formatPercent(-12.5)).toBe('12.5%');
    });
});
