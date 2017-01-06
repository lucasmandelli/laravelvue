<template>
    <div id="app">
        <div class="spinner-fixed" v-if="loading">
            <div class="spinner">
                <div class="indeterminate"></div>
            </div>
        </div>

        <header>
            <spa-menu v-if="showMenu"></spa-menu>
        </header>

        <main>
            <router-view></router-view>
        </main>

        <footer class="page-footer">
            <div class="footer-copyright">
                <div class="container">
                    &copy; {{ year }} <a class="grey-text text-lighten-4" href="#">Financial System</a>
                </div>
            </div>
        </footer>
    </div>
</template>

<script type="text/javascript" >
    import SpaMenuComponent from './SpaMenu.vue';
    import Auth from '../services/auth'
    export default {
        components: {
            'spa-menu': SpaMenuComponent
        },
        created() {
            window.Vue.http.interceptors.unshift((request, next) => {
                this.loading = true;
                next(() => this.loading = false);
            });
        },
        data() {
            return {
                year: new Date().getFullYear(),
                user: Auth.user,
                loading: false
            }
        },
        computed: {
            showMenu() {
                return this.user.check && this.$route.name != 'auth.login';
            }
        }
    };
</script>