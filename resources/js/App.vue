<template>
    <div>
        <router-view />
    </div>
    <!-- <Topbar />
    <Sidebar />
    <div class="content-page">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <router-view></router-view>
                    </div>
                </div>
            </div>
        </div>
        <Footer />
    </div> -->

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
    <!-- <div class="container">
        <div class="text-center" style="margin: 20px 0px 20px 0px">
            <span class="text-secondary">Laravel Vue CRUD Example</span>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <router-link to="/" class="nav-item nav-link"
                        >Home</router-link
                    >
                    <router-link to="/add" class="nav-item nav-link"
                        >Add Post</router-link
                    >
                </div>
            </div>
        </nav>
        <br />
        <router-view></router-view>
    </div> -->
</template>

<script>
import Sidebar from "./partials/Sidebar.vue";
import Topbar from "./partials/Topbar.vue";
import Footer from "./partials/Footer.vue";
export default {
    components: { Sidebar, Topbar, Footer },
};
</script>
