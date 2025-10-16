export function invoiceRendererData(invoice = {}) {
    const tableBody = document.getElementById('invoice-table-body');

    tableBody.innerHTML = '';

    if (!invoice || !invoice.id) {
        tableBody.innerHTML = `<tr><td colspan="6" class="text-center text-gray-500">No hay datos de factura</td></tr>`;
        return;
    }

    // Formateador de moneda
    const formatCurrency = value => {
        const number = parseFloat(value ?? 0);
        return number.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
    };

    const row = document.createElement('tr');
    row.innerHTML = `
        <td class="text-center">${formatCurrency(invoice.total_sale)}</td>
        <td class="text-center">${formatCurrency(invoice.total_discount)}</td>
        <td class="text-center">${formatCurrency(invoice.received_amount)}</td>
        <td class="text-center">${formatCurrency(invoice.change_amount)}</td>
        <td class="text-center">${invoice.payment_method ?? '—'}</td>
        <td class="text-center">${invoice.client?.customer_name ?? 'Cliente desconocido'}</td>
    `;
    tableBody.appendChild(row);
}