import { parseNumber } from "../utils/parseNumber";
import { roundToDecimals } from "../utils/roundTwoDecimals";

export function calculatePrice(costWithTaxes, utility) {
    const cost = parseNumber(costWithTaxes);
    const gabela = 5000;
    const revenue = roundToDecimals(cost * (utility / 100));

    return roundToDecimals(cost + revenue + gabela);
}
