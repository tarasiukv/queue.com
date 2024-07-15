import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import io from "socket.io-client";
window.io = io

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: '127.0.0.1:6001',
    // host: window.location.hostname + ':6001'
});
