<template>
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center">
        <div class="container-fluid no-gutters">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-5 d-flex flex-column align-items-center justify-content-center py-4 login-box-wrapper">
                    <div id="login-box">
                        <div class="d-flex justify-content-center py-4">
                        <a href="#" class="logo d-flex align-items-center w-auto">
                            <img src="src/assets/growme-logo.png" alt="">
                            <span class="d-none d-lg-block"></span>
                        </a>
                        </div>
                        <div class="card mb-3" style="background: #e7e7e7;">
                            <div class="card-body">

                            <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                <p class="text-center small">Enter your username & password to login</p>
                                <p class="text-center small invalid-feedback" v-if="this.loginIntervalMessage" v-html="this.loginIntervalMessage" style="display: block; background: #ffcece; padding: 10px 15px; border-radius: 4px;border: 1px solid #d6a2a2;"></p>
                            </div>

                                <form class="row g-3 needs-validation" @submit="submit">

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Username</label>
                                        <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input autocomplete="off" placeholder="john.doe@example.com" type="text" name="username" class="form-control" id="yourUsername" required v-model="form.email">
                                        <div class="invalid-feedback">Please enter your username.</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input placeholder="***********" type="password" name="password" class="form-control" id="yourPassword" required v-model="form.password">
                                        <div class="invalid-feedback">Please enter your password!</div>
                                    </div>

                                    <div class="col-12">
                                        <button class="btn btn-danger w-100" type="submit" :disabled="this.loggingIn">Login</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">Don't have account? <a href="#">Create an account</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-sm-12 backgroun-login">

                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapActions } from "vuex";

export default {
    name: 'Login',
    data() {
        return {
            form: {
                email: '',
                password: ''
            },
            user: {},
            errors: {},
            loginIntervalMessage: '',
            loggingIn: false
        }
    },
    methods: {
        ...mapActions({
            signIn: "auth/signIn"
        }),
        submit(e) {
            e.preventDefault();
            this.loginIntervalMessage = '';
            this.loggingIn = true;
            this.signIn(this.form)
            .then((authuser) => {
                this.user = authuser;
                window.location.href = '/dashboard';
            })
            .catch(error => {
                if (error.response.status === 401) {
                    this.loginIntervalMessage = '<b class="text-maroon">Login Failed</b>. Please enter correct email/password.';
                }
                this.loggingIn = false;
            });
        }
    }
}
</script>


<style scoped>
.logo img {
    max-height: 60px;
    margin-right: 0;
}
.login-box-wrapper {
    background: #272727;
}
#login-box {
    max-width: 400px;
}
.backgroun-login {
    background-image:url('src/assets/login-bg.jpg');
    background-repeat: no-repeat;
    background-size: cover;
    height: 100vh;
}
h5.card-title.text-center.pb-0.fs-4 {
    color: #ec1b24;
}
</style>