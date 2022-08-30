<template>
    <Layout>
        <div class="row">
            <div class="col grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit User</h6>
                        <div class="alert alert-primary" role="alert">
                            <b>Note :</b> The User account will have access to
                            play BFF games
                        </div>
                        <form class="forms-sample" @submit.prevent="submit">
                            <div class="mb-3">
                                <label for="name" class="form-label"
                                    >Name</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="{ 'border-danger': errors.name }"
                                    id="name"
                                    v-model="formData.name"
                                    autocomplete="off"
                                    placeholder="Name"
                                />
                                <span
                                    v-if="errors.name"
                                    class="text-danger fs-6 d-block mt-1"
                                    >{{ errors.name[0] }}</span
                                >
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label"
                                    >Email address</label
                                >
                                <input
                                    type="email"
                                    v-model="formData.email"
                                    class="form-control"
                                    :class="{ 'border-danger': errors.email }"
                                    id="email"
                                    placeholder="Email"
                                />
                                <span
                                    v-if="errors.email"
                                    class="text-danger fs-6 d-block mt-1"
                                    >{{ errors.email[0] }}</span
                                >
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label"
                                    >New Password</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="password"
                                    v-model="formData.password"
                                    :class="{
                                        'border-danger': errors.password,
                                    }"
                                    autocomplete="off"
                                    placeholder="Password"
                                />
                                <span
                                    v-if="errors.password"
                                    class="text-danger fs-6 d-block mt-1"
                                    >{{ errors.password[0] }}</span
                                >
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label"
                                    >Confirm New Password</label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    id="confirm_password"
                                    :class="{
                                        'border-danger': errors.password,
                                    }"
                                    v-model="formData.password_confirmation"
                                    autocomplete="off"
                                    placeholder="Password (Again)"
                                />
                                <span
                                    v-if="errors.password"
                                    class="text-danger fs-6 d-block mt-1"
                                    >{{ errors.password[0] }}</span
                                >
                            </div>
                            <button
                                type="submit"
                                class="btn btn-primary me-2"
                                :disabled="isLoading"
                            >
                                {{ isLoading ? "Please wait..." : "Update" }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
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
            formData: {},
            errors: {},
        };
    },
    methods: {
        ...mapActions({
            getUserEditAction: "getUserEditAction",
            updateUserAction: "updateUserAction",
        }),
        async submit() {
            this.isLoading = true;
            await this.updateClientAction({
                id: this.$route.params.id,
                data: this.formData,
            })
                .then((res) => {
                    console.log(res);
                    this.isLoading = false;
                    if (res.success === false) {
                        this.errors = res.errors;
                    } else if (res.success === true) {
                        this.getEditDetail();
                        this.formData = {};
                    }
                })
                .catch((err) => {
                    console.log(err);
                    this.isLoading = false;
                });
        },
        async getEditDetail() {
            const result = await this.getUserEditAction(this.$route.params.id);
            console.log("r", result.data.results);
            if (result.success === false) {
                this.$router.push("/users");
            } else {
                this.formData = result.data.results;
            }
        },
    },
    created() {
        this.getEditDetail();
    },
};
</script>
