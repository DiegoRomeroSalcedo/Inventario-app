import { getData, postData } from "./api";
import { getSaleList, getTotals } from "./saleList";
import { parseNumber } from "../utils/parseNumber";
import { parse } from "postcss";

export function initFinalizeSale() {

    const finalizeButton = document.getElementById("finalize-sale");
    const receivedInput = document.getElementById("received_amount");
    const changeInput = document.getElementById("change");
    const paymentMethodInput = document.getElementById('payment_method');
    const customerIdInput = document.getElementById('customer_id');
    const identificationInput = document.getElementById('identification');
    const nameInput = document.getElementById('customer_name');
    const phoneInput = document.getElementById('phone');
    const emailInput = document.getElementById('email');
    const addressInput = document.getElementById('address');

    if (!finalizeButton) return;

    finalizeButton.addEventListener("click", async () => {
        const saleList = getSaleList();
        const total = parseNumber(getTotals().total);
        // console.log(total);
        const subtotal = total / 1.19;
        console.log(saleList);

        const received = parseNumber(receivedInput.value) || 0; 
        const change = parseNumber(changeInput.value) || 0; 
        const paymentMethod = paymentMethodInput.value;
        const customerId = customerIdInput?.value || null;

        if (saleList.length === 0) {
            return alert("La lista de venta está vacía.");
        }

        if (received < total) {
            return alert("El monto recibido es insuficiente.");
        }

        // Construimos el objeto base de la factura
        const salesData = {
            // subtotal,
            total_sale: total,
            // total_base: subtotal,
            // total_iva: total - subtotal,
            total_discount: saleList.reduce((sum, item) => sum + ((item.discount / 100) * (item.price * item.quantity)), 0),
            received_amount: received,
            change_amount: change,
            payment_method: paymentMethod,
            items: saleList, // para enviar el detalle de los productos
        };

        // Si existe un ID, lo usamos directamente
        if (customerId) {
            salesData.client_id = customerId;
        } else {
            // Si no existe, enviamos los datos del nuevo cliente
            salesData.customer = {
                identification: identificationInput.value.trim(),
                name: nameInput.value.trim(),
                phone: phoneInput.value.trim(),
                email: emailInput.value.trim(),
                address: addressInput.value.trim(),
            };
        }

        try {
            const response = await postData(`/invoices`, salesData, {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
            });

            console.log(response);
            alert("Venta registrada correctamente ✅");
            window.location.href = `/invoices/${response.sale_id}`;
        } catch (error) {
            console.error("Error al registrar la venta:", error);
            alert("Ocurrió un error al registrar la venta ❌");
        }
    });
}
