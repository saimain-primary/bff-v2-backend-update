require("./bootstrap");

import { createApp } from "vue";
import router from "./routers";
import App from "./App.vue";
import VueAxios from "vue-axios";
import axios from "axios";
import store from "./store";
const app = createApp({});

axios.defaults.headers.common["Authorization"] = `Bearer ${localStorage.getItem(
    "token"
)}`;

app.component("app", App);
app.use(router);
app.use(VueAxios, axios);
app.use(store);

app.mount("#app");
