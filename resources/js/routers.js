import { createWebHistory, createRouter } from "vue-router";
import AdminList from "./pages/admins/AdminList.vue";
import AddAdmin from "./pages/admins/AddAdmin.vue";
import EditAdmin from "./pages/admins/EditAdmin.vue";

import UserList from "./pages/users/UserList.vue";
import AddUser from "./pages/users/AddUser.vue";
import EditUser from "./pages/users/EditUser.vue";

import ActivityLogs from "./pages/logs/Activity.vue";
import Dashboard from "./pages/Dashboard.vue";
import Login from "./pages/auth/Login.vue";
import store from "./store";
import axios from "axios";

const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`,
        },
    },
    {
        name: "dashboard",
        path: "/",
        component: Dashboard,
        meta: {
            title: `Dashboard`,
            middleware: "auth",
        },
    },
    {
        name: "admins",
        path: "/admins",
        component: AdminList,
        meta: {
            title: `Admin List`,
            middleware: "super_admin",
        },
    },
    {
        name: "add_admin",
        path: "/admins/add",
        component: AddAdmin,
        meta: {
            title: `Create new Admin account`,
            middleware: "super_admin",
        },
    },
    {
        name: "edit_admin",
        path: "/admins/edit/:id",
        component: EditAdmin,
        meta: {
            title: `Edit Admin account`,
            middleware: "super_admin",
        },
    },
    {
        name: "users",
        path: "/users",
        component: UserList,
        meta: {
            title: `User List`,
            middleware: "admin",
        },
    },
    {
        name: "add_user",
        path: "/users/add",
        component: AddUser,
        meta: {
            title: `Add User`,
            middleware: "admin",
        },
    },
    {
        name: "edit_user",
        path: "/users/edit/:id",
        component: EditUser,
        meta: {
            title: `Edit User account`,
            middleware: "admin",
        },
    },
    {
        name: "activity_logs",
        path: "/activity-logs",
        component: ActivityLogs,
        meta: {
            title: `Activity Logs`,
            middleware: "super_admin",
        },
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const isAuth = store.state.authenticated;

    if (isAuth) {
        const authToken = localStorage.getItem("token");
        axios
            .get("/api/me", {
                headers: {
                    Authorization: `Bearer ${authToken}`,
                },
            })
            .then((res) => {
                if (res.data.status !== 200) {
                    localStorage.removeItem("token");
                    localStorage.removeItem("vuex");
                    store.state.authenticated = false;
                    store.state.user = {};
                    router.push({ path: "/login" });
                }
            })
            .catch((err) => {
                console.log(err);
            });
    }

    let role = "";
    if (isAuth) {
        role = store.state.user.data.user.role;
    } else {
        role = "";
    }
    document.title = to.meta.title;
    if (to.meta.middleware == "guest") {
        if (isAuth) {
            next({ name: "dashboard" });
        }
        next();
    } else if (to.meta.middleware == "super_admin") {
        if (isAuth && role === "SUPER_ADMIN") {
            next();
        } else {
            next({ name: "dashboard" });
        }
    } else if (to.meta.middleware == "admin") {
        if (isAuth && role === "ADMIN") {
            next();
        } else {
            next({ name: "dashboard" });
        }
    } else if (to.meta.middleware == "client") {
        if (isAuth && role === "CLIENT") {
            next();
        } else {
            next({ name: "dashboard" });
        }
    } else {
        if (isAuth) {
            next();
        } else {
            next({ name: "login" });
        }
    }
});

export default router;
