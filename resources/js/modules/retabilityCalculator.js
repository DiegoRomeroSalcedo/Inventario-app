import { parseNumber } from "../utils/parseNumber";
import { roundToDecimals } from "../utils/roundTwoDecimals";

export function calculateRentability(finalPrice, costWithTaxes) {
    console.log(finalPrice);
    console.log(costWithTaxes);
    const price = parseNumber(finalPrice);
    const cost = parseNumber(costWithTaxes);

    return roundToDecimals(((price - cost) / price) * 100)
}