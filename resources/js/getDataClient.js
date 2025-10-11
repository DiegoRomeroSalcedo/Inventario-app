import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
    const inputCc = document.getElementById('customer_cc');

    inputCc.addEventListener('blur', async function() {
        const cc = this.value.trim();

        if (cc === '') return;

        try {
            const response = await axios.get(`/clients/data/${cc}`);
            const data = response.data;

            if (data.exists) {
                alert(`Cliente encontrado: ${data.client.name}`);
            } else {
                alert("Cliente no encontrado");
            }
        } catch(error) {
            console.error("Error al buscar el cliente:", error);
        }
    })
})