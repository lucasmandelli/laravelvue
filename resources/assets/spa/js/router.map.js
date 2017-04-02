import LoginComponent from './components/Login.vue';
import LogoutComponent from './components/Logout.vue';
import DashboardComponent from './components/Dashboard.vue';
import BankAccountComponent from './components/bank-account/BankAccount.vue';
import BankAccountListComponent from './components/bank-account/BankAccountList.vue';
import BankAccountCreateComponent from './components/bank-account/BankAccountCreate.vue';
import BillPayComponent from './components/bill-pay/BillPay.vue';
import BillPayListComponent from './components/bill-pay/BillPayList.vue';
import BillPayCreateComponent from './components/bill-pay/BillPayCreate.vue';
import BillReceivedComponent from './components/bill-receive/BillReceive.vue';
import BillReceivedListComponent from './components/bill-receive/BillReceiveList.vue';
import BillReceivedCreateComponent from './components/bill-receive/BillReceiveCreate.vue';
import CategoryComponent from './components/category/Category.vue';
import AccountPlanRevenuesComponent from './components/account-plan/revenues/Category.vue';
import AccountPlanExpensesComponent from './components/account-plan/expenses/Category.vue';

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
                component: BankAccountListComponent,
                auth: true
            },
            '/create': {
                name: 'bank-account.create',
                component: BankAccountCreateComponent,
                auth: true
            },
            '/:id/update': {
                name: 'bank-account.update',
                component: BankAccountCreateComponent,
                auth: true
            },
            '/:id/delete': {
                name: 'bank-account.delete',
                component: BankAccountListComponent,
                auth: true
            }
        }
    },
    '/bills-pay': {
        component: BillPayComponent,
        subRoutes: {
            '/': {
                name: 'bills-pay.list',
                component: BillPayListComponent,
                auth: true
            },
            '/create': {
                name: 'bills-pay.create',
                component: BillPayCreateComponent,
                auth: true
            },
            '/:id/update': {
                name: 'bills-pay.update',
                component: BillPayCreateComponent,
                auth: true
            },
            '/:id/delete': {
                name: 'bills-pay.delete',
                component: BillPayListComponent,
                auth: true
            }
        }
    },
    '/bills-receive': {
        component: BillReceivedComponent,
        subRoutes: {
            '/': {
                name: 'bills-receive.list',
                component: BillReceivedListComponent,
                auth: true
            },
            '/create': {
                name: 'bills-receive.create',
                component: BillReceivedCreateComponent,
                auth: true
            },
            '/:id/update': {
                name: 'bills-receive.update',
                component: BillReceivedCreateComponent,
                auth: true
            },
            '/:id/delete': {
                name: 'bills-receive.delete',
                component: BillReceivedListComponent,
                auth: true
            }
        }
    },
    '/categories': {
        name: 'category.list',
        component: CategoryComponent,
        auth: true
    },
    '/account-plan-revenues': {
        name: 'account-plan-revenues',
        component: AccountPlanRevenuesComponent,
        auth: true
    },
    '/account-plan-expenses': {
        name: 'account-plan-expenses',
        component: AccountPlanExpensesComponent,
        auth: true
    }
}