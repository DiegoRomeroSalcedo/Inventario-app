export function formatPrice(value) {
    if (!value) return '';

    // Quitamos puntos o comas y deja solo números
    const numericValue = value.toString().replace(/[.,\s]/g, '');

    // Si no es número, devolvemos vacío
    if (isNaN(numericValue)) return '';

    // Devolvemos con formato de miles (sin decimales)
    return new Intl.NumberFormat('de-De').format(numericValue);
}

export function formattedPrice(value) {
    return value.toLocaleString('es-CO', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}