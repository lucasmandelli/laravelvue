export class Jwt {
    static accessToken(email, password) {
        return Vue.http.post('access_token', {
            email: email,
            password: password
        });
    }

    static logout() {
        return Vue.http.post('logout');
    }

    static refreshToken() {
        return Vue.http.post('refresh_token');
    }
}

let User = Vue.resource('user');
let BankAccount = Vue.resource('bank-accounts{/id}');
let Bank = Vue.resource('banks');
let BillsPay = Vue.resource('bills-pay{/id}', {}, {
    status: {
        method: 'GET',
        url: 'bills-pay/status/'
    },
    total: {
        method: 'GET',
        url: 'bills-pay/total/'
    }
});
let BillsReceived = Vue.resource('bills-receive{/id}', {}, {
    status: {
        method: 'GET',
        url: 'bills-receive/status/'
    },
    total: {
        method: 'GET',
        url: 'bills-receive/total/'
    }
});
let Category = Vue.resource('categories{/id}');

export {User, BankAccount, Bank, BillsPay, BillsReceived, Category};