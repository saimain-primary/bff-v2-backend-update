<template>
    <div class="main-wrapper">
        <Sidebar />

        <div class="page-wrapper">
            <Topbar />
            <div class="page-content">
                <slot />
            </div>
            <Footer />
        </div>
    </div>
</template>

<script>
import Sidebar from "../partials/Sidebar.vue";
import Topbar from "../partials/Topbar.vue";
import Footer from "../partials/Footer.vue";

export default {
    components: { Sidebar, Topbar, Footer },
};
</script>
