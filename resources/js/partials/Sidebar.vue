<template>
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar">
        <div class="sidebar-header">
            <a href="#" class="sidebar-brand"> Noble<span>UI</span> </a>
            <div class="sidebar-toggler not-active">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div class="sidebar-body">
            <ul class="nav">
                <li class="nav-item nav-category">Main</li>
                <li class="nav-item" :class="{'active': isActiveRoute('/')}">
                    <router-link to="/" class="nav-link">
                         <vue-feather
                                class="link-icon"
                                type="box"
                            ></vue-feather>
                        <span class="link-title">Dashboard</span>
                    </router-link>
                </li>

                <template v-if="user.role === 'SUPER_ADMIN'">
                    <li class="nav-item nav-category">Admins</li>
                    <li class="nav-item" :class="{'active': isActiveRoute('/admins')}">
                        <router-link to="/admins" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="list"
                            ></vue-feather>
                            <span class="link-title">List</span></router-link
                        >
                    </li>
                    <li class="nav-item" :class="{'active': isActiveRoute('/admins/add')}">
                        <router-link to="/admins/add" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="plus"
                            ></vue-feather>
                            <span class="link-title">Add</span></router-link
                        >
                    </li>
                </template>

                <template v-if="user.role === 'ADMIN'">
                    <li class="nav-item nav-category">Clients</li>
                    <li class="nav-item" :class="{'active': isActiveRoute('/clients')}">
                        <router-link to="/clients" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="list"
                            ></vue-feather>

                            <span class="link-title">List</span></router-link
                        >
                    </li>
                    <li class="nav-item" :class="{'active': isActiveRoute('/clients/add')}">
                        <router-link to="/clients/add" class="nav-link">
                            <vue-feather
                                class="link-icon"
                                type="plus"
                            ></vue-feather>
                            <span class="link-title">Add</span></router-link
                        >
                    </li>
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
        isActiveRoute(path){
            if(this.$route.path === path){
                return true;
            }else{
                return false;
            }
        }
    },
  
};
</script>

<style></style>
