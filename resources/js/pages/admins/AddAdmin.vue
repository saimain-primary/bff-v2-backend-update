<template>
    <Layout>
        <div>
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="header-title">
                                        New Admin Information
                                    </h4>
                                    <p class="sub-header">
                                        Admins have access to manage the
                                        information of <code>Client</code>
                                    </p>

                                    <div class="row">
                                        <div class="col">
                                            <form @submit.prevent="submit">
                                                <div class="mb-3">
                                                    <label
                                                        for="name"
                                                        class="form-label"
                                                        >Name</label
                                                    >
                                                    <input
                                                        type="text"
                                                        id="name"
                                                        v-model="formData.name"
                                                        class="form-control"
                                                        placeholder="Name"
                                                    />
                                                </div>

                                                <div class="mb-3">
                                                    <label
                                                        for="email"
                                                        class="form-label"
                                                        >Email</label
                                                    >
                                                    <input
                                                        type="email"
                                                        v-model="formData.email"
                                                        id="email"
                                                        class="form-control"
                                                        placeholder="Email"
                                                    />
                                                </div>

                                                <div class="mb-3">
                                                    <label
                                                        for="password"
                                                        class="form-label"
                                                        >Password</label
                                                    >
                                                    <input
                                                        type="password"
                                                        v-model="
                                                            formData.password
                                                        "
                                                        id="password"
                                                        class="form-control"
                                                        placeholder="password"
                                                    />
                                                </div>
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary waves-effect waves-light"
                                                >
                                                    Create
                                                </button>
                                            </form>
                                        </div>
                                        <!-- end col -->
                                    </div>
                                    <!-- end row-->
                                </div>
                                <!-- end card-body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- container -->
            </div>
            <!-- content -->
        </div>
    </Layout>
</template>

<script>
import Layout from "../Layout.vue";
import { mapActions } from "vuex";

export default {
    components: { Layout },
    data() {
        return {
            isLoading: false,
            formData: {
                name: "",
                email: "",
                password: "",
            },
        };
    },
    methods: {
        ...mapActions({
            createNewAdminAction: "createNewAdminAction",
        }),
        async submit() {
            this.isLoading = true;
            await this.createNewAdminAction(this.formData)
                .then((res) => {
                    console.log(res);
                    if (res.success === true) {
                        this.isLoading = false;
                        this.formData = {};
                    }
                })
                .catch((err) => {
                    console.log(err);
                    this.isLoading = false;
                });
        },
    },
    mounted() {},
};
</script>
