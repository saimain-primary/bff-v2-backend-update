<template>
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand"> BFF<span>Admin</span> </a>
            <div class="sidebar-toggler not-active" @click="toggleNavbar">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="sidebar-body">
            <ul class="nav">
                <li class="nav-item nav-category">Main</li>
                <li class="nav-item" :class="{ active: isActiveRoute('/') }">
                    <router-link to="/" class="nav-link">
                        <vue-feather class="link-icon" type="box"></vue-feather>
                        <span class="link-title">Dashboard</span>
                    </router-link>
                </li>

                <template v-if="user.role === 'SUPER_ADMIN'">
                    <li class="nav-item nav-category">Admins</li>
                    <li
                        class="nav-item"
                        :class="{ active: isActiveRoute('/admins') }"
                    >
                        <router-link to="/admins" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="list"
                            ></vue-feather>
                            <span class="link-title">List</span></router-link
                        >
                    </li>
                    <li
                        class="nav-item"
                        :class="{ active: isActiveRoute('/admins/add') }"
                    >
                        <router-link to="/admins/add" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="plus"
                            ></vue-feather>
                            <span class="link-title">Add</span></router-link
                        >
                    </li>
                    <li class="nav-item nav-category">Logs</li>
                    <li
                        class="nav-item"
                        :class="{ active: isActiveRoute('/activity-logs') }"
                    >
                        <router-link to="/activity-logs" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="git-branch"
                            ></vue-feather>
                            <span class="link-title"
                                >Activity</span
                            ></router-link
                        >
                    </li>
                </template>

                <template v-if="user.role === 'ADMIN'">
                    <li class="nav-item nav-category">Users</li>
                    <li
                        class="nav-item"
                        :class="{ active: isActiveRoute('/users') }"
                    >
                        <router-link to="/users" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="list"
                            ></vue-feather>

                            <span class="link-title">List</span></router-link
                        >
                    </li>
                    <li
                        class="nav-item"
                        :class="{ active: isActiveRoute('/users/add') }"
                    >
                        <router-link to="/users/add" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="plus"
                            ></vue-feather>
                            <span class="link-title">Add</span></router-link
                        >
                    </li>

                    <li class="nav-item nav-category">Dataset</li>
                    <li
                        class="nav-item"
                        :class="{ active: isActiveRoute('/fixtures') }"
                    >
                        <router-link to="/fixtures" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="layers"
                            ></vue-feather>

                            <span class="link-title"
                                >Fixtures</span
                            ></router-link
                        >
                    </li>
                    <li
                        class="nav-item"
                        :class="{ active: isActiveRoute('/teams') }"
                    >
                        <router-link to="/teams" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="users"
                            ></vue-feather>

                            <span class="link-title">Teams</span></router-link
                        >
                    </li>

                    <li class="nav-item nav-category">Predictions Game</li>
                    <li
                        class="nav-item"
                        :class="{ active: isActiveRoute('/predictions') }"
                    >
                        <router-link to="/predictions" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="check-square"
                            ></vue-feather>

                            <span class="link-title"
                                >Predictions</span
                            ></router-link
                        >
                    </li>
                    <li
                        class="nav-item"
                        :class="{ active: isActiveRoute('/leaderboard') }"
                    >
                        <router-link to="/leaderboard" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="trending-up"
                            ></vue-feather>

                            <span class="link-title"
                                >Leaderboard</span
                            ></router-link
                        >
                    </li>

                    <li class="nav-item nav-category">Analytics</li>
                    <li
                        class="nav-item"
                        :class="{ active: isActiveRoute('/predictions') }"
                    >
                        <router-link to="/predictions" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="trello"
                            ></vue-feather>

                            <span class="link-title"
                                >Google Analytics</span
                            ></router-link
                        >
                    </li>
                    <li
                        class="nav-item"
                        :class="{ active: isActiveRoute('/') }"
                    >
                        <router-link to="/" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="play"
                            ></vue-feather>

                            <span class="link-title">Hotjar</span></router-link
                        >
                    </li>

                    <li class="nav-item nav-category">Resources</li>
                </template>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            user: this.$store.state.user.data.user,
        };
    },
    methods: {
        toggleNavbar() {
            console.log("Toggler working");
            $(".sidebar-header .sidebar-toggler").toggleClass(
                "active not-active"
            );
            if (window.matchMedia("(min-width: 992px)").matches) {
                $("body").toggleClass("sidebar-folded");
            } else if (window.matchMedia("(max-width: 991px)").matches) {
                $("body").toggleClass("sidebar-open");
            }
        },
        isActiveRoute(path) {
            if (this.$route.path === path) {
                return true;
            } else {
                return false;
            }
        },
    },
};
</script>

<style></style>
