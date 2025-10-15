import { getSaleList, getTotals } from "./saleList";
import { initPriceFormatting } from "./priceFormatter";
import { parseNumber } from "../utils/parseNumber";
import { formattedPrice } from "../utils/formatters";

export function initSaleTotals() {
    const totalInput = document.getElementById("total_sale");
    const receivedInput = document.getElementById("received_amount");
    const changeInput = document.getElementById("change");

    initPriceFormatting([
        '#received_amount'
    ]);

    function calculateTotal() {
        const list = getSaleList();
        const total = getTotals().total;
        totalInput.value = total;
        return total;
    }

    function calculateChange() {
        const total = parseNumber(calculateTotal());
        const received = parseNumber(receivedInput.value);
        const change = formattedPrice(received - total);
        changeInput.value = change;
    }

    // Recalculamos el total si se carga o actualiza la lista.
    calculateTotal();

    // cuando el cliente escribe el monto recibido -> recalculamos el cambio
    receivedInput.addEventListener("input", () => calculateChange());

    // Devolvemos funciones para que se puedan usar externamente
    return {
        updateTotals: () => {
            calculateTotal();
            calculateChange();
        }
    }
}