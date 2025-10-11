import axios from "axios";

document.addEventListener("DOMContentLoaded", () => {
    const inputId = document.getElementById("id");
    const dataSection = document.getElementById("data-product");
    const listTable = document.querySelector("#list tbody");
    let list = [];
    
    inputId.addEventListener('blur', async function() {
        const id = this.value.trim();

        if (!id) return;

        try {
            const response = await axios.get(`/products/data/${id}`);
            const data = response.data;

            if (data.exists) {
                renderProduct(data);
            } else {
                dataSection.innerHTML = `<p>Producto no encontrado.</p>`;
            }
        } catch (error) {
            console.error("Error al buscar el producto:", error);
        }
    });

    function renderProduct(data) {
        let html = `
            <h4><strong>Código</strong> ${data.data.id}</h4>
            <p><strong>Nombre:</strong> ${data.data.name}</p>
            <p><strong>Marca:</strong> ${data.data.brand.name} </p>
            <p><strong>Precio:</strong> ${data.data.price} </p>
            <p><strong>Descuento:</strong> ${data.data.discount} </p>
            <p><strong>Precio Final:</strong> ${data.data.price_with_discount} </p>
            <p><strong>Detalle:</strong> ${data.data.details} </p>
            <p><strong>Tipo de unidad:</strong> ${data.data.unity_type} </p>
            <p><strong>Unidad de medida:</strong> ${data.data.unit_of_measure} </p>
            <p><strong>Cantidad en inventario:</strong> ${data.data.stock.quantity} </p>
        `;

        if (data.data.unity_type === 'unit') {
            html += `
                <div>
                    <button id="decrease">-</button>
                    <input type="number" id="quantity" value="1" min="1" max="${data.data.stock.quantity}">
                    <button id="increase">+</button>
                </div>
            `;
        } else {
            html += `
                <div>
                    <label>Cantidad (${data.data.unit_of_measure}):</label>
                    <input type="number" id="quantity" value="0" min="0" step="0.01">
                </div>
            `;
        }

        html += `<button id="add-to-list">Agregar a la lista</button>`;

        dataSection.innerHTML = html;

        // Lógica cantidad si es unitario
        if (data.data.unity_type === 'unit') {
            const inputQuantity = document.getElementById('quantity');
            document.getElementById("increase").addEventListener("click", () => {
                if (inputQuantity.value < data.data.stock.quantity)
                    inputQuantity.value = Number(inputQuantity.value) + 1;
            });
            document.getElementById("decrease").addEventListener("click", () => {
                if (inputQuantity > 1)
                    inputQuantity.value = Number(inputQuantity.value) - 1
            });
        }

        // Agregamos a la lista
        document.getElementById("add-to-list").addEventListener("click", () => {
            const quantity = Number(document.getElementById("quantity").value);
            // console.log(quantity);
            if (quantity < 0) {
                alert("La cantidad debe ser mayor que 0");
                return;
            }

            const subtotal = data.data.price_with_discount * quantity;

            const exists = list.some(item => item.id === data.data.id);
            // console.log(exists);

            if (exists) {
                list = list.map(item => {
                    if (item.id === data.data.id) {
                        return {
                            ...item,
                            quantity: item.quantity + quantity,
                            subtotal: item.subtotal + subtotal
                        };
                    }
                    return item;
                });
            } else {
                list.push({
                    id: data.data.id,
                    name: data.data.name,
                    brand: data.data.brand.name,
                    IVA: data.data.IVA,
                    price: data.data.price_with_discount,
                    "%DTO": data.data.discount,
                    discount: data.data.discount,
                    quantity,
                    subtotal,
                });
            }

            renderList();
            dataSection.innerHTML = "";
            inputId.value = "";
        });
    }

    function renderList() {
        listTable.innerHTML = list.map(item => `
                <tr>
                    <td>${item.id}</td>
                    <td>${item.name}</td>
                    <td>${item.brand}</td>
                    <td>${item.quantity}</td>
                    <td>${item.IVA}%</td>
                    <td>$${item.price}</td>
                    <td>${item["%DTO"]}%</td>
                    <td>$${item.subtotal.toFixed(2)}</td>
                    <td><button class="remove-to-list" data-id="${item.id}">X</button></td>
                </tr>
            `).join("");

            const deleteButtons = document.querySelectorAll(".remove-to-list");

            deleteButtons.forEach(button => {
                button.addEventListener("click", (e) => {
                    // console.log("Hello");
                    const id = parseInt(e.target.dataset.id);
                    deleteItem(id);
                });
            });


            function deleteItem(id) {
                if (confirm("¿Estás seguro de eliminar este producto de la lista?")) {
                    list = list.filter(item => item.id !== id);
                    renderList();
                }
            }
    }
});