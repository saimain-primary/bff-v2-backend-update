import { createStore } from "vuex";
import axios from "axios";
import createPersistedState from "vuex-persistedstate";
import router from "../routers";
import { useToast } from "vue-toastification";

const toast = useToast();

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
        // Auth
        async login({ commit }, data) {
            try {
                axios.defaults.headers.common[
                    "Authorization"
                ] = `Bearer ${localStorage.getItem("token")}`;
                const loginData = await axios.get("/api/user");
                commit("SET_USER", loginData);
                commit("SET_AUTHENTICATED", true);
                router.go("/");
                toast.success("Welcome Back!", {
                    transition: "Vue-Toastification__bounce",
                    hideProgressBar: true,
                });
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
            toast.error("Successfully Logged out!", {
                transition: "Vue-Toastification__bounce",
                hideProgressBar: true,
            });
        },

        // Admin
        async createNewAdminAction({ commit }, data) {
            const result = await axios.post("/api/admins", data);
            if (result.status == 500)
                return {
                    success: false,
                    data: [],
                    message: result.message,
                    error: [],
                };

            toast.success(result.data.message, {
                transition: "Vue-Toastification__bounce",
                hideProgressBar: true,
            });

            return {
                success: true,
                data: result,
                message: result.message,
                error: [],
            };
        },
    },
});

export default store;
