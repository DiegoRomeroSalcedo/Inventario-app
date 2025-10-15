import { formatPrice } from "../utils/formatters";

export function initPriceFormatting(inputs = []) {
    inputs.forEach(selector => {
        const input = document.querySelector(selector);
        if (!input) return;

        input.addEventListener('input', e => {
            const cursorPos = e.target.selectionStart;
            const formatted = formatPrice(e.target.value);
            e.target.value = formatted;

            // Opcional: manterner posicion del cursor al final
            e.target.setSelectionRange(formatted.length, formatted.length)
        })
    })
}