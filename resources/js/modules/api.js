import axios from 'axios';

export async function getData(url) {
    try {
        const response = await axios.get(url);
        return response.data;
    } catch (error) {
        console.error("Error fetching data: ", error);
        throw error;
    }
}

export async function postData(url, data, options = {}) {
    const response = await fetch(url, {
        method: "POST",
        body: JSON.stringify(data),
        ...options,
    });

    const json = await response.json();

    return {
        status: response.status, // ✅ Incluimos el status HTTP
        data: json
    };
}
