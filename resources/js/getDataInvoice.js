import { getData } from "./modules/api";
import { renderSalesList } from "./modules/salesList";
import { initFinalizeReturn } from "./modules/finalizeReturn";
import { invoiceRendererData } from "./modules/invoiceRenderer";

document.addEventListener('DOMContentLoaded', () => {
    const invoiceInput = document.getElementById('invoice_id');

    invoiceInput.addEventListener('blur', async function() {
        const value = this.value.trim();

        const response = await getData(`/invoices/data/${value}`);
        const invoice = response.data ?? {};
        invoiceRendererData(invoice);
        renderSalesList(response.data.sales ?? []);
        initFinalizeReturn(invoice);
    })
});