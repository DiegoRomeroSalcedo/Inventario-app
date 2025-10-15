import { parseNumber } from "../utils/parseNumber";
import { roundToDecimals } from "../utils/roundTwoDecimals";

export function calculateFinalPrice(price, discount) {
    const parsePrice = parseNumber(price);
    const totalDiscount = roundToDecimals(parsePrice * (discount / 100));
    
    return roundToDecimals(parsePrice - totalDiscount);
}