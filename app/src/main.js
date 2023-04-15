import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import axios from "axios";
import Toaster from "@meforma/vue-toaster";
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap-icons/font/bootstrap-icons.css";
import "bootstrap";
import "./assets/main.css";
import "@/store/subscriber";

axios.defaults.baseURL = "http://growmeapi.local:8000/api";
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
axios.defaults.headers.common['Authorization'] = `Bearer ${localStorage.getItem('token')}`;

const app = createApp(App);
app.use(store);
app.use(router);
app.use(Toaster, {
    position: 'top-right'
}).provide('toast', app.config.globalProperties.$toast);
app.mount("#app");
