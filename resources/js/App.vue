<template>
    <div>
        <router-view />
    </div>
</template>

<script>
import Sidebar from "./partials/Sidebar.vue";
import Topbar from "./partials/Topbar.vue";
import Footer from "./partials/Footer.vue";
export default {
    components: { Sidebar, Topbar, Footer },
};
</script>
