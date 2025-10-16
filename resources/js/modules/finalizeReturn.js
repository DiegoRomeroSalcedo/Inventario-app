import { postData } from "./api";  
export function initFinalizeReturn(invoice) { 
    const button = document.getElementById('finalize-return'); 
    if (!button) return; 
    
    button.addEventListener('click', async () => { 
        const rows = document.querySelectorAll('#sales-table-body tr'); 
        const devoluciones = []; 
        
        rows.forEach(row => { 
            const cantidadInput = row.querySelector('.devolver-cantidad'); 
            const checkbox = row.querySelector('.reinsertar-checkbox'); 
            if (!cantidadInput) return; 
            
            const cantidad = parseInt(cantidadInput.value); 
            if (cantidad > 0) { 
                const sale = invoice.sales.find(s => s.id == cantidadInput.dataset.saleId);
                console.log(sale);
                devoluciones.push({ 
                    sale_id: cantidadInput.dataset.saleId,
                    product_id: sale.product.id,  
                    cantidad: cantidad,
                    unit_price: sale.product.price_with_discount, 
                    reinsertar: checkbox.checked 
                }); 
            } 
        });
        
        // devoluciones.forEach(item => {
        //     console.log(item);
        // });
        
        if (devoluciones.length === 0) {
            alert('Debes seleccionar al menos una unidad para devolver.'); 
            return; 
        } // Confirmación visual 

            
        if (!confirm('¿Deseas registrar la devolución?')) return; 
        try { 
            const payload = { 
                invoice_id: invoice.id, 
                reason: document.getElementById('reason').value || '',
                devoluciones 
            }; 

            console.log(payload);
            
            const response = await postData('/returns', payload, {
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                },
            }); 
            alert('Devolución registrada correctamente'); 
            console.log('Respuesta del servidor:', response); 
        } catch (error) { 
            console.error('Error al registrar la devolución:', error); 
            alert('Hubo un problema al registrar la devolución'); 
        } 
    });
}