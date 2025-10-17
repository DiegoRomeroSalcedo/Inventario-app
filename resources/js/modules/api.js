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

export async function postData(url = '', data = {}, options = {}) {
    const response = await fetch(url, {
        method: 'POST',
        body: JSON.stringify(data),
        ...options
    });

    const contentType = response.headers.get("content-type");
    const responseData = contentType && contentType.includes("application/json")
        ? await response.json()
        : await response.text();

    // ⚠️ Lanzar error si la respuesta no es exitosa
    if (!response.ok) {
        const error = new Error('Error en la solicitud');
        error.response = {
            status: response.status,
            data: responseData
        };
        throw error;
    }

    return responseData;
}

