export function formatPrice(value) {
    if (value === null || value === undefined) return '';

    // Quitamos cualquier cosa que no sea número o separador
    const numericValue = value.toString().replace(/[^\d,.-]/g, '');
    if (numericValue === '') return '';

    const parsed = parseFloat(numericValue.replace(',', '.'));
    if (isNaN(parsed)) return '';

    // Mostramos con separador de miles y 2 decimales
    return parsed.toLocaleString('es-CO', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

export function formattedPrice(value) {
    const num = parseFloat(value);
    if (isNaN(num)) return '0.00';

    return num.toLocaleString('es-CO', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}
