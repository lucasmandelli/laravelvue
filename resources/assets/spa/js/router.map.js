import LoginComponent from './components/Login.vue';
import LogoutComponent from './components/Logout.vue';
import DashboardComponent from './components/Dashboard.vue';
import BankAccountComponent from './components/bank-account/BankAccount.vue';
import BankAccountListComponent from './components/bank-account/BankAccountList.vue';
import BankAccountCreateComponent from './components/bank-account/BankAccountCreate.vue';

export default {
    '/login': {
        name: 'auth.login',
        component: LoginComponent,
        auth: false
    },
    '/logout': {
        name: 'auth.logout',
        component: LogoutComponent,
        auth: true
    },
    '/dashboard': {
        name: 'dashboard',
        component: DashboardComponent,
        auth: true
    },
    '/bank-accounts': {
        component: BankAccountComponent,
        subRoutes: {
            '/': {
                name: 'bank-account.list',
                component: BankAccountListComponent
            },
            '/create': {
                name: 'bank-account.create',
                component: BankAccountCreateComponent
            },
            '/:id/update': {
                name: 'bank-account.update',
                component: BankAccountCreateComponent
            },
            '/:id/delete': {
                name: 'bank-account.delete',
                component: BankAccountListComponent
            }
        }
    }
}