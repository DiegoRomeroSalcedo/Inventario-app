export function parseNumber(value) {
    return parseFloat(value.replace(/\./g, '').replace(',', '.')) || 0;
}