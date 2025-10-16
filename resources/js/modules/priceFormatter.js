import { formatPrice } from "../utils/formatters";
import { parseNumber } from "../utils/parseNumber";

export function initPriceFormatting(inputs = []) {
    inputs.forEach(selector => {
        const input = document.querySelector(selector);
        if (!input) return;

        input.addEventListener('blur', e => {
            const parsed = parseNumber(e.target.value);
            e.target.value = formatPrice(parsed);
        });
    });
}
