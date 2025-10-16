export function parseNumber(value) {
    if (!value) return 0;

    // Convertimos a string
    let str = value.toString().trim();

    // Eliminamos símbolos de moneda, espacios, etc.
    str = str.replace(/[^\d,.-]/g, '');

    // Si contiene coma y punto, detectamos el formato
    // Ej: "10.000,50" -> europeo, "10,000.50" -> americano
    if (str.includes(',') && str.includes('.')) {
        // Si el último símbolo es coma -> formato europeo
        if (str.lastIndexOf(',') > str.lastIndexOf('.')) {
            str = str.replace(/\./g, '').replace(',', '.'); // 10.000,50 -> 10000.50
        } else {
            str = str.replace(/,/g, ''); // 10,000.50 -> 10000.50
        }
    } else {
        // Si solo tiene comas, las tratamos como decimales
        if (str.includes(',')) str = str.replace(',', '.');
        // Si solo tiene puntos, verificamos si es decimal o miles
        const parts = str.split('.');
        if (parts.length > 2) str = parts.join(''); // muchos puntos -> miles
    }

    const number = parseFloat(str);
    return isNaN(number) ? 0 : number;
}
