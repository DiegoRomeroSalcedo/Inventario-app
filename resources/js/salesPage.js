import { getData } from "./modules/api";
import { renderProduct } from "./modules/productRenderer";
import { addItem, initSaleList } from "./modules/saleList";
import { initFinalizeSale } from "./modules/saleFinalize";
// import { initPriceFormatting } from "./modules/priceFormatter";

document.addEventListener("DOMContentLoaded", () => {
    initSaleList();
    initFinalizeSale();
    // initPriceFormatting([
    //     '#change'
    // ]);
    
    const inputId = document.getElementById("id");
    const dataSection = document.getElementById("data-product");

    inputId.addEventListener('blur', async () => {
        const id = inputId.value.trim();
        if (!id) return;

        try {
            const response = await getData(`/products/data/${id}`);
            if (response.exists) {
                renderProduct(response.data, addItem);
            } else {
                dataSection.innerHTML = `<p>Producto no encontrado.</p>`;
            }
        } catch (error) {
            console.error("Error al buscar el producto:", error);
        }
    });
}); 