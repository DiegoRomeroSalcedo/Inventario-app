import axios from 'axios';

document.addEventListener('DOMContentLoaded', () => {
    const inputCc = document.getElementById('identification');
    const inputCustomerId = document.getElementById('customer_id');

    inputCc.addEventListener('blur', async function() {
        const cc = this.value.trim();

        if (cc === '') return;

        try {
            const response = await axios.get(`/clients/data/cc/${cc}`);
            const data = response.data;
            console.log(data);

            if (!data.success) {
                alert(`Cliente no encontrado: ${data.client.name}`);
                inputCustomerId.value = '';
            } else {
                inputCustomerId.value = data.client.id;
                const inputCustomerName = document.getElementById('customer_name');
                const inputPhone = document.getElementById('phone');
                const inputEmail = document.getElementById('email');
                const inputAddress = document.getElementById('address')


                console.log(data.client);
                inputCustomerName.value = data.client.customer_name || '';
                inputPhone.value = data.client.phone || '';
                inputEmail.value = data.client.email || '';
                inputAddress.value = data.client.address || '';
            }
        } catch(error) {
            console.error("Error al buscar el cliente:", error);
        }
    })
})