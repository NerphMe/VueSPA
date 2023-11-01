import axios from 'axios';

const apiClient = axios.create({
    baseURL: 'https://laravel-qo50.frb.io/api',
    timeout: 1000,
    headers: {
        'Content-Type': 'application/json',
    },
});

export default apiClient;
