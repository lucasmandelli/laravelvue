<template>
    <div class="container">
        <div class="row">
            <div class="col s8 offset-s2 z-depth-2 panel">
                <h3 class="center">Financial System</h3>

                <div class="row" v-if="error.error">
                    <div class="col s12">
                        <div class="card-panel red-text">
                            {{ error.message }}
                        </div>
                    </div>
                </div>

                <form method="POST" @submit.prevent="login()">

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="email" type="email" class="validate" name="email" v-model="user.email" required autofocus>
                            <label for="email" class="active" >E-mail</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" class="validate" name="password" v-model="user.password" required>
                            <label for="password" class="active">Password</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <button type="submit" class="btn">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import Auth from '../services/auth';

    export default {
        data() {
            return {
                user: {
                    email: '',
                    password: ''
                },
                error: {
                    error: false,
                    message: ''
                }
            }
        },
        methods: {
            login() {
                Auth.login(this.user.email, this.user.password)
                    .then(() => this.$router.go({name: 'dashboard'}))
                    .catch((responseError) => {
                        switch (responseError.status) {
                            case 401:
                                this.error.message = responseError.data.message;
                                break;
                            default:
                                this.error.message = 'Login failed';
                        }
                        this.error.error = true;
                    });
            }
        }
    }
</script>