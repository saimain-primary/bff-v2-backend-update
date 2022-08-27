require("./bootstrap");

import { createApp } from "vue";
import router from "./routers";
import App from "./App.vue";
import VueAxios from "vue-axios";
import axios from "axios";
import store from "./store";
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";
import VueFeather from "vue-feather";

const app = createApp({});

if (localStorage.getItem("token")) {
    axios.defaults.headers.common[
        "Authorization"
    ] = `Bearer ${localStorage.getItem("token")}`;
}

app.component("app", App);
app.component(VueFeather.name, VueFeather);
app.use(router);
app.use(VueAxios, axios);
app.use(store);

app.use(Toast, {
    transition: "Vue-Toastification__bounce",
    maxToasts: 20,
    newestOnTop: true,
});

app.config.devtools = true;

app.mount("#app");
