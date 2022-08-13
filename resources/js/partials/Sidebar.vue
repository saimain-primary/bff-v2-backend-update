<template>
    <div class="left-side-menu">
        <div class="h-100" data-simplebar>
            <div id="sidebar-menu">
                <ul id="side-menu">
                    <li class="menu-title">Welcome</li>

                    <li>
                        <router-link to="/" class="nav-item nav-link">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span
                                class="badge bg-success rounded-pill float-end"
                                >9+</span
                            >
                            <span> Dashboard </span></router-link
                        >
                    </li>

                    <li v-if="user.role !== 'CLIENT'" class="menu-title mt-2">
                        Account Management
                    </li>

                    <template v-if="user.role === 'SUPER_ADMIN'">
                        <li>
                            <a href="#admin" data-bs-toggle="collapse">
                                <i class="mdi mdi-account-group-outline"></i>
                                <span> Admins </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="admin">
                                <ul class="nav-second-level">
                                    <li>
                                        <router-link to="/admins/add"
                                            >Add</router-link
                                        >
                                    </li>
                                    <li>
                                        <router-link to="/admins"
                                            >List</router-link
                                        >
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </template>

                    <template v-if="user.role === 'ADMIN'">
                        <li>
                            <a href="#client" data-bs-toggle="collapse">
                                <i class="mdi mdi-account-group-outline"></i>
                                <span> Clients </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="client">
                                <ul class="nav-second-level">
                                    <li>
                                        <router-link to="/clients/add"
                                            >Add</router-link
                                        >
                                    </li>
                                    <li>
                                        <router-link to="/clients"
                                            >List</router-link
                                        >
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: this.$store.state.user.data.user,
        };
    },
};
</script>

<style></style>
