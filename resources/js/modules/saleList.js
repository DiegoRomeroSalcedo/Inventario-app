import { initSaleTotals } from "./saleTotals";
import { formattedPrice } from "../utils/formatters";

let saleList = [];
let totalsController = null;

export function initSaleList() {
    totalsController = initSaleTotals();
}

export function addItem(product, quantity) {
    const subtotal = product.price_with_discount * quantity;
    const exists = saleList.some(item => item.id === product.id);
    const discountValue = (product.price - product.price_with_discount) * quantity;

    if (exists) {
        saleList = saleList.map(item => 
            item.id === product.id
                ? { ...item, quantity: item.quantity + quantity, subtotal: item.subtotal + subtotal }
                : item
        );
    } else {
        saleList.push({
            id: product.id,
            name: product.name,
            brand: product.brand.name,
            IVA: product.IVA ?? 'N/A',
            price: product.price,
            priceWithDiscount: product.price_with_discount,
            discount: product.discount,
            total_discount: discountValue,
            quantity,
            subtotal,
        });
    }

    renderList();
    totalsController.updateTotals(); // Recalculamos totales y cambio
}

export function removeItem(id) {
    saleList = saleList.filter(item => item.id !== id);
    renderList();
}

export function renderList() {
    const tbody = document.querySelector("#list tbody");
    tbody.innerHTML = saleList.map(item => `
        <tr>
            <td class="text-center">${item.id}</td>
            <td class="text-center">${item.name}</td>
            <td class="text-center">${item.brand}</td>
            <td class="text-center">${item.quantity}</td>
            <td class="text-center">${item.IVA}%</td>
            <td class="text-center">$${item.price}</td>
            <td class="text-center">${item.discount}%</td>
            <td class="text-center">$${item.subtotal.toFixed(2)}</td>
            <td class="text-center"><button class="remove-item bg-white border border-gray-800 px-3 py-1 rounded-md hover:bg-gray-200 transition" data-id="${item.id}">Remover Item</button></td>
        </tr>
    `).join("");

    document.querySelectorAll(".remove-item").forEach(btn => {
        btn.addEventListener("click", e => removeItem(parseInt(e.target.dataset.id)));
    });
}

export function getSaleList() {
    return saleList;
}

export function getTotals() {
    const total = formattedPrice(saleList.reduce((sum, item) => sum + Number(item.subtotal || 0), 0));
    // aquí meto los calculos de  IVA, descuentos, etc. segun la logica que yo necesite
    return {
        total,
    }
}

// export function getTotalDiscount() {
    
// }