<template>
    <ul :id="actions.id" class="dropdown-content" v-for="actions in menuDropdown">
        <li v-for="item in actions.items">
            <a v-link="{name: item.routeName}" class="blue-grey-text">{{ item.name }}</a>
        </li>
    </ul>
    <ul id="dropdown-logout" class="dropdown-content">
        <li>
            <a v-link="{name: 'auth.logout'}">Logout</a>
        </li>
    </ul>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s12">
                        <a href="#" class="brand-logo">Vue Contas</a>
                        <a href="#" data-activates="nav-mobile" class="button-collapse">
                            <i class="material-icons">menu</i>
                        </a>
                        <ul class="right hide-on-med-and-down">
                            <li v-for="menu in menus">
                                <a v-if="menu.dropdownId" class="dropdown-button" href="!#" :data-activates="menu.dropdownId">
                                    {{ menu.name }}
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                                <a v-else v-link="{name: menu.routeName}">{{ menu.name }}</a>
                            </li>
                            <li>
                                <a class="dropdown-button" href="!#" data-activates="dropdown-logout">
                                    {{ name }} <i class="material-icons right">arrow_drop_down</i>
                                </a>
                            </li>
                        </ul>
                        <ul id="nav-mobile" class="side-nav">
                            <li v-for="menu in menus">
                                <a v-link="{name: menu.routeName}">{{ menu.name }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script type="text/javascript" >
    import Auth from '../services/auth';
    export default {
        ready() {
            $('.button-collapse').sideNav();
            $('.dropdown-button').dropdown();
        },
        data() {
            return {
                menus: [
                    {name: "Dashboard", routeName: 'dashboard'},
                    {name: "Bank Accounts", dropdownId: 'bank-account'},
                    {name: "Bills", dropdownId: 'bills'},
                    {name: "Account Plan", routeName: 'account-plan-revenues'},
                    {name: "Categories", routeName: 'category.list'},
                ],
                menuDropdown: [
                    {
                        id: 'bank-account',
                        items: [
                            {id: 0, name: "List accounts", routeName: 'bank-account.list'},
                            {id: 1, name: "Create account", routeName: 'bank-account.create'}
                        ]
                    },
                    {
                        id: 'bills',
                        items: [
                            {id: 0, name: "Bills Pay", routeName: 'bills-pay.list'},
                            {id: 1, name: "Bills Receive", routeName: 'bills-receive.list'}
                        ]
                    },
                ],
                user: Auth.user
            };
        },
        computed: {
            name() {
                return this.user.data ? this.user.data.name : 'My Account';
            }
        }
    };

</script>