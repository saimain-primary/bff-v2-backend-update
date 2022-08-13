<template>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 sm:items-cente sm:pt-0"
    >
        <!-- Begin page -->
        <div id="wrapper">
            <Topbar />
            <Sidebar />
            <div class="content-page">
                <slot></slot>
                <Footer />
            </div>
        </div>
        <!-- END wrapper -->
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
