export function renderSalesList(sales = []) {
    const tableBody = document.querySelector('#sales-table-body');
    if (!tableBody) return console.warn('No se encontró el contenedor de ventas');

    tableBody.innerHTML = '';

    if (sales.length === 0) {
        tableBody.innerHTML = `<tr><td colspan="7" class="text-center text-gray-500">No hay productos en esta factura</td></tr>`;
        return;
    }


    sales.forEach((sale, index) => {
        const total = parseFloat(sale.quantity) * parseFloat(sale.product.price_with_discount);

        const row = document.createElement('tr');
        row.innerHTML = `
            <td class="text-center">${index + 1}</td>
            <td class="text-center">${sale.product?.name ?? '—'}</td>
            <td class="text-center">${Number(sale.quantity)}</td>
            <td class="text-center">${parseFloat(sale.product.price).toLocaleString('es-CO', { style: 'currency', currency: 'COP' })}</td>
            <td class="text-center">${Number(sale.product.discount)}</td>
            <td class="text-center">${parseFloat(sale.product.price_with_discount).toLocaleString('es-CO', { style: 'currency', currency: 'COP' })}</td>
            <td class="text-center">${total.toLocaleString('es-CO', { style: 'currency', currency: 'COP' })}</td>
            <td class="text-center">
                <input 
                    type="number" 
                    min="1" 
                    max="${sale.quantity}" 
                    value="0" 
                    class="border rounded-md w-16 text-center devolver-cantidad"
                    data-sale-id="${sale.id}">
            </td>
            <td class="text-center">
                <input 
                    type="checkbox" 
                    class="reinsertar-checkbox" 
                    data-sale-id="${sale.id}" 
                    checked>
            </td>
        `;
        tableBody.appendChild(row);
    });

    // 🔹 Escuchar cambios en cantidad
    tableBody.addEventListener('input', e => {
        if (e.target.classList.contains('devolver-cantidad')) {
            const cantidad = parseInt(e.target.value);
            const max = parseInt(e.target.max);

            if (cantidad > max) {
                e.target.value = max;
                alert(`Solo puedes devolver hasta ${max} unidades.`);
            } else if (cantidad < 0) {
                e.target.value = 0;
            }
        }
    });
}
