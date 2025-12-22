import { parseNumber } from "../utils/parseNumber";
import { roundToDecimals } from "../utils/roundTwoDecimals";

export function calculateFinalPrice(price, discount) {
    const parsePrice = parseNumber(price);
    const parseDiscount = parseNumber(discount);
    const finalPrice = roundToDecimals(parsePrice + parseDiscount);
    
    return roundToDecimals(finalPrice);
}