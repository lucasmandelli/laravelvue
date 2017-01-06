<template>
    <ul :id="actions.id" class="dropdown-content" v-for="actions in config.menusDropdown">
        <li v-for="item in actions.items" :class="menuItemClass(item)">
            <a :href="item.url" class="blue-grey-text">{{ item.name }}</a>
        </li>
    </ul>
    <ul id="dropdown-logout" class="dropdown-content">
        <li>
            <a :href="config.urlLogout" @click.prevent="goToLogout()">
                Logout
            </a>
            <form id="logout-form" :action="config.urlLogout" method="POST" style="display: none;">
                <input type="hidden" name="_token" :value="config.csrfToken" />
            </form>
        </li>
    </ul>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
                <div class="row">
                    <div class="col s12">
                        <a href="#" class="brand-logo">Financial System - Admin</a>
                        <a href="#" data-activates="nav-mobile" class="button-collapse">
                            <i class="material-icons">menu</i>
                        </a>
                        <ul class="right hide-on-med-and-down">
                            <li v-for="menu in config.menus" :class="menuItemClass(menu)">
                                <a v-if="menu.dropdownId" class="dropdown-button" href="!#"
                                   :data-activates="menu.dropdownId">
                                    {{ menu.name }}
                                    <i class="material-icons right">arrow_drop_down</i>
                                </a>
                                <a v-else :href="menu.url">{{ menu.name }}</a>
                            </li>
                            <li>
                                <a class="dropdown-button" href="!#" data-activates="dropdown-logout">
                                    {{ config.name }} <i class="material-icons right">arrow_drop_down</i>
                                </a>
                            </li>
                        </ul>
                        <ul id="nav-mobile" class="side-nav">
                            <li v-for="menu in config.menus">
                                <a :href="menu.url">{{ menu.name }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script type="text/javascript" >

    export default {
        props: {
            config: {
                type: Object,
                default() {
                    return {
                        name: '',
                        menus: [],
                        menusDropdown: [],
                        urlLogout: '/admin/logout'
                    }
                }
            }
        },
        ready() {
            $('.button-collapse').sideNav();
            $('.dropdown-button').dropdown();
        },
        methods: {
            goToLogout() {
                $("#logout-form").submit();
            },
            menuItemClass(menu) {
                let menuClass = ['active'];

                if(menu.active) {
                    return menuClass;
                }

                if(menu.dropdownId !== undefined) {
                    let dropdown = this.config.menusDropdown.find((element) => {
                        return element.id == menu.dropdownId;
                    });

                    if(dropdown) {
                        for(let item of dropdown.items) {
                            if(item.active) {
                                return menuClass;
                            }
                        }
                    }
                }
            }
        }
    };

</script>