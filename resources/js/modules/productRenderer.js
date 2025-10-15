export function renderProduct(data, onAddToList) {
    const section = document.getElementById('data-product');

    let html = `
        <h4><strong>Código</strong> ${data.id}</h4>
        <p><strong>Nombre:</strong> ${data.name}</p>
        <p><strong>Marca:</strong> ${data.brand.name} </p>
        <p><strong>Precio:</strong> ${data.price} </p>
        <p><strong>Descuento:</strong> ${data.discount} </p>
        <p><strong>Precio Final:</strong> ${data.price_with_discount} </p>
        <p><strong>Detalle:</strong> ${data.details} </p>
        <p><strong>Tipo de unidad:</strong> ${data.unity_type} </p>
        <p><strong>Unidad de medida:</strong> ${data.unit_of_measure} </p>
        <p><strong>Cantidad en inventario:</strong> ${data.stock.quantity} </p>
    `;

    if (data.unity_type === 'unit') {
        html += `
            <div>
                <button id="decrease">-</button>
                <input type="number" id="quantity" value="1" min="1" max="${data.stock.quantity}">
                <button id="increase">+</button>
            </div>
        `;
    } else {
        html += `
            <div>
                <label>Cantidad (${data.unit_of_measure}):</label>
                <input type="number" id="quantity" value="0" min="0" step="0.01">
            </div>
        `;
    }

    html += `<button id="add-to-list">Agregar a la lista</button>`;
    section.innerHTML = html;

    // Control de botones +/-
    if (data.unity_type === 'unit') {
        const quantityInput = document.getElementById("quantity");
        document.getElementById("increase").addEventListener("click", () => {
            if (quantityInput.value < data.stock.quantity)
                quantityInput.value = Number(quantityInput.value) + 1;
        });
        document.getElementById("decrease").addEventListener("click", () => {
            if (quantityInput.value > 1)
                quantityInput.value = Number(quantityInput.value) - 1;
        });
    }

    // Botón de agregar
    document.getElementById("add-to-list").addEventListener("click", () => {
        const quantity = Number(document.getElementById("quantity").value);
        if (quantity <= 0) return alert("Cantidad inválida");
        onAddToList(data, quantity);
    });
}