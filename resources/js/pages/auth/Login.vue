<template>
    <div class="page-wrapper full-page" style="margin-top: 100px">
        <div
            class="page-content d-flex align-items-center justify-content-center"
        >
            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4 pe-md-0">
                                <div class="auth-side-wrapper"></div>
                            </div>
                            <div class="col-md-8 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a
                                        href="#"
                                        class="noble-ui-logo d-block mb-2"
                                        >Noble<span>UI</span></a
                                    >
                                    <h5 class="text-muted fw-normal mb-4">
                                        Welcome back! Log in to your account.
                                    </h5>
                                    <form
                                        class="forms-sample"
                                        @submit.prevent="login"
                                    >
                                        <div class="mb-3">
                                            <label
                                                for="userEmail"
                                                class="form-label"
                                                >Email address</label
                                            >
                                            <input
                                                type="email"
                                                class="form-control"
                                                id="userEmail"
                                                placeholder="Email"
                                                v-model="auth.email"
                                            />
                                        </div>
                                        <div class="mb-3">
                                            <label
                                                for="userPassword"
                                                class="form-label"
                                                >Password</label
                                            >
                                            <input
                                                type="password"
                                                class="form-control"
                                                v-model="auth.password"
                                                id="userPassword"
                                                autocomplete="current-password"
                                                placeholder="Password"
                                            />
                                        </div>
                                        <div class="form-check mb-3">
                                            <input
                                                type="checkbox"
                                                class="form-check-input"
                                                id="authCheck"
                                                checked
                                            />
                                            <label
                                                class="form-check-label"
                                                for="authCheck"
                                            >
                                                Remember me
                                            </label>
                                        </div>
                                        <div>
                                            <button
                                                type="submit"
                                                class="btn btn-primary me-2 mb-2 mb-md-0 text-white"
                                            >
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from "vuex";
export default {
    data() {
        return {
            auth: {
                email: "",
                password: "",
            },
            validationErrors: {},
            processing: false,
        };
    },
    methods: {
        ...mapActions({
            signIn: "login",
        }),
        login() {
            this.processing = true;
            axios
                .post("api/login", this.auth)
                .then(({ data }) => {
                    localStorage.setItem("token", data.authorization.token);
                    this.signIn(data);
                })
                .catch(({ response }) => {
                    console.log(response);
                    if (response.status === 422) {
                        this.validationErrors = response.data.errors;
                    } else {
                        this.validationErrors = {};
                        alert(response.data.message);
                    }
                })
                .finally(() => {
                    this.processing = false;
                });
        },
    },
};
</script>

<style></style>
