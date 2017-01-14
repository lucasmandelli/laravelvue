export class BankAccountClass {
    constructor(data = {}) {
        this.name = '';
        this.agency = 0;
        this.account = 0;
        this.default = false;
        this.bank_id = 1;
        this.bank = {
            id: 1,
            name: ''
        }

        Object.assign(this, data);
    }

    toJSON() {
        return {
            name: this.name,
            agency: this.agency,
            account: this.account,
            'default': this.default,
            bank_id: this.bank_id,
            bank: this.bank
        }
    }
};