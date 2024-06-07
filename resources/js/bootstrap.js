import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';
import io from "socket.io-client";
window.io = io

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: import.meta.env.VITE_ECHO_SERVER_HOST + ':' + import.meta.env.VITE_ECHO_SERVER_HOST_PORT,
});
