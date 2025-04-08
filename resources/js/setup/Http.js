import axios from "axios";
import AuthStore from "../store/AuthStore.js";
import {useRouter} from "vue-router";
import router from "../router";
const token = localStorage.getItem('token');
const Http = axios.create({
    baseURL: `${import.meta.env.VITE_APP_URL}`,
    timeout: import.meta.env.VITE_API_TIMEOUT,
    withCredentials: true,
    headers: {
        'Accept': 'application/json'
    }
})
export  async function setCSRfToken (){
    await Http.get('/sanctum/csrf-cookie')
}


Http.interceptors.response.use(
    (response) => {
        return response;
    },
     async function (error) {
        if (error.response.status === 401 || error.response.status === 419) {
            const store = AuthStore();
            store.expired();
            await router.push('login');
        }
        return Promise.reject(error.response);
    }
);

export default Http;
