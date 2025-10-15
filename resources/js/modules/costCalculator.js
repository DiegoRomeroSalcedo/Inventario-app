import { parseNumber } from "../utils/parseNumber";
import { roundToDecimals } from "../utils/roundTwoDecimals";

export function calculateTotalCost(cost, retencion, flete, iva) {
    const base = parseNumber(cost);
    const totalRentencion = roundToDecimals(base * (retencion / 100));
    const totalFlete = roundToDecimals(base * (flete / 100));
    const totalIva = roundToDecimals(base * (iva / 100));

    return roundToDecimals(base + totalRentencion + totalFlete + totalIva);
}