import { createStore } from "vuex";
import axios from "axios";
import createPersistedState from "vuex-persistedstate";
import router from "../routers";
// Create a new store instance.
const store = createStore({
    plugins: [createPersistedState()],
    state: {
        authenticated: false,
        user: {},
    },
    getters: {
        authenticated(state) {
            return state.authenticated;
        },
        user(state) {
            return state.user.data;
        },
    },
    mutations: {
        SET_AUTHENTICATED(state, value) {
            state.authenticated = value;
        },
        SET_USER(state, value) {
            state.user = value;
        },
    },
    actions: {
        async login({ commit }, data) {
            try {
                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${localStorage.getItem("token")}`;
                const loginData = await axios.get("/api/user");
                commit("SET_USER", loginData);
                commit("SET_AUTHENTICATED", true);
                router.push({ name: "dashboard" });
            } catch (error) {
                console.log(error);
                commit("SET_USER", {});
                commit("SET_AUTHENTICATED", false);
            }
        },
        logout({ commit }) {
            commit("SET_USER", {});
            commit("SET_AUTHENTICATED", false);
            router.push({ name: "login" });
        },
    },
});

export default store;
