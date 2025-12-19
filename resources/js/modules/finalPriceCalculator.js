import { parseNumber } from "../utils/parseNumber";
import { roundToDecimals } from "../utils/roundTwoDecimals";

export function calculateFinalPrice(price, discount) {
    const parsePrice = parseNumber(price);
    const finalPrice = roundToDecimals(parsePrice + discount);
    
    return roundToDecimals(finalPrice);
}