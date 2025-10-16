import { initPriceFormatting } from "./modules/priceFormatter";
import { formattedPrice } from "./utils/formatters";
import { calculateTotalCost } from "./modules/costCalculator";
import { calculatePrice } from "./modules/priceCalculator";
import { calculateFinalPrice } from "./modules/finalPriceCalculator";
import { calculateRentability } from "./modules/retabilityCalculator";

document.addEventListener('DOMContentLoaded', () => {
    const cost = document.getElementById('cost');
    const retencionInput = document.getElementById('retencion');
    const fleteInput = document.getElementById('flete');
    const ivaInput = document.getElementById('IVA');
    const costWithTaxesInput = document.getElementById('cost_with_taxes');
    const utilityInput = document.getElementById('utility');
    const priceInput = document.getElementById('price');
    const discountInput = document.getElementById('discount');
    const expirationInput = document.getElementById('expiration_date');
    const finalPriceInput = document.getElementById('price_with_discount');
    const rentabilityInput = document.getElementById('rentability');


    initPriceFormatting([
        '#cost'
    ])

    function updateCost() {
        console.log(cost.value);
        const total = calculateTotalCost(cost.value, retencionInput.value, fleteInput.value, ivaInput.value);
        costWithTaxesInput.value = formattedPrice(total);
    }

    function updatePrice() {
        const price = calculatePrice(costWithTaxesInput.value, utilityInput.value);
        priceInput.value = formattedPrice(price);
    }

    function updateFinalPrice() {
        const finalPrice = calculateFinalPrice(priceInput.value, discount.value);
        finalPriceInput.value = formattedPrice(finalPrice);
    }

    function updateRentability() {
        const rentability = calculateRentability(finalPriceInput.value, costWithTaxesInput.value);
        rentabilityInput.value = formattedPrice(rentability);
    }

    cost.addEventListener('input', () => {
        updateCost();
        updatePrice();
        updateFinalPrice();
        updateRentability();
    });
    retencionInput.addEventListener('input', updateCost);
    fleteInput.addEventListener('input', updateCost);
    ivaInput.addEventListener('input', updateCost);
    utilityInput.addEventListener('input', () => {
        updatePrice();
        updateFinalPrice();
    });
    discountInput.addEventListener('input', () => {
        updateFinalPrice();
        updateRentability();
    });
})