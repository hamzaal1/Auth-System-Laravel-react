import axios from "axios";

const axios_instance_user = axios.create({
    baseURL: 'http://127.0.0.1:8000/api/',
    // withCredentials: true
    // timeout: 5000,
    // headers: { 'X-Custom-Header': 'foobar' }
});

export default axios_instance_user;