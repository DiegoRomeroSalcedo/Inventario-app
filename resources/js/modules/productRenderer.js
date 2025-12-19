export function renderProduct(data, onAddToList) {
    const tableBody = document.getElementById('product-table-body');
    tableBody.innerHTML = '';

    if (!data || !data.id) {
        tableBody.innerHTML = `
            <tr><td colspan="12" class="text-center text-gray-500">Producto no encontrado</td></tr>
        `;
        return;
    }

    const formatCurrency = value => {
        const number = parseFloat(value ?? 0);
        return number.toLocaleString('es-CO', { style: 'currency', currency: 'COP' });
    };

    // Introducimos un estado booleano para el mecanismo de control
    let discountApplied = false;

    // Crear fila
    const row = document.createElement('tr');
    row.innerHTML = `
        <td class="text-center">${data.id}</td>
        <td class="text-center">${data.name}</td>
        <td class="text-center">${data.brand?.name ?? '—'}</td>
        <td class="text-center">${formatCurrency(data.price)}</td>
        <td class="text-center">
            <label class="flex items-center justify-center gap-1 cursor-pointer text-sm">
                <input type="checkbox" id="apply-discount" />
                Applicar descuento
            </label>
        </td>
        <td class="text-center" id="final-price">
            ${formatCurrency(data.price_with_discount)}
        </td>
        <td class="text-center">${data.details ?? '—'}</td>
        <td class="text-center">${data.stock?.quantity ?? 0}</td>
        <td class="text-center">
            <input type="number" id="quantity" value="${data.unity_type === 'unit' ? 1 : 0}" 
                min="1" max="${data.stock?.quantity ?? 0}" step="${data.unity_type === 'unit' ? 1 : 0.01}"
                class="border rounded-md w-20 text-center dark:bg-[#181818] dark:text-gray-300"
            />
        </td>
        <td class="text-center">
            <button id="add-to-list" 
                class="bg-white dark:bg-gray-700 border border-gray-800 px-3 py-1 rounded-md hover:bg-gray-200 transition">
                Agregar
            </button>
        </td>
    `;

    tableBody.appendChild(row);

    const discountCheckbox = document.getElementById("apply-discount");
    const finalPriceTd = document.getElementById("final-price");

    discountCheckbox.addEventListener("change", () => {
        discountApplied = discountCheckbox.checked;

        const effectivePrice = discountApplied
            ? data.price
            : data.price_with_discount;

        finalPriceTd.textContent = formatCurrency(effectivePrice);
    });

    // Botón de agregar
    document.getElementById("add-to-list").addEventListener("click", () => {
        const quantity = Number(document.getElementById("quantity").value);
        if (quantity <= 0) return alert("Cantidad inválida");

        const finalPrice = discountApplied
            ? data.price
            : data.price_with_discount;

        onAddToList(
            {
                ...data,
                finalPrice: finalPrice,
                discount_applied: discountApplied
            },
            quantity);
    });
}
