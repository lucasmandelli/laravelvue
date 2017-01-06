<template>
    <div class="container">
        <div class="row">
            <div class="col s12 z-depth-2 panel">
                <div class="row valign-wrapper">
                    <div class="col s6">
                        <h5 v-if="formType == 'insert'">Account Create</h5>
                        <h5 v-else>Account Edit</h5>
                    </div>
                    <div class="col s6">
                        <div class="valign">
                            <a class="btn waves-effect right" v-link="{name: 'bank-account.list'}">
                                <i class="material-icons">arrow_back</i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <form name="formAccountCreate" @submit.prevent="submit">
                    <div class="row">
                        <div class="input-field col s6">
                            <label for="name" class="active">Name</label>
                            <input type="text" id="name" v-model="bankAccount.name" >
                        </div>
                        <div class="input-field col s6">
                            <label for="bank-id" class="active">Bank</label>
                            <!--<select v-model="bankAccount.bank_id" id="bank_id" class="browser-default">
                                <option value="" disabled selected >Choose...</option>
                                <option v-for="bank in banks" :value="bank.id" >{{ bank.name }}</option>
                            </select>-->
                            <input type="text" id="bank-id" placeholder="Choose a bank" autocomplete="off"
                                data-activates="bank-id-dropdown" data-beloworigin="true" />
                            <ul id="bank-id-dropdown" class="dropdown-content ac-dropdown"></ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <label for="agency" class="active">Agency</label>
                            <input type="text" id="agency" v-model="bankAccount.agency" placeholder="Agency" >
                        </div>
                        <div class="input-field col s6">
                            <label for="account" class="active">Account</label>
                            <input type="text" id="account" v-model="bankAccount.account" placeholder="Account number" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <input type="checkbox" id="default" v-model="bankAccount.default" >
                            <label for="default">Default</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="right">
                            <button type="submit" class="btn waves-effect waves-dark" >Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import {BankAccount, Bank} from '../../services/resources';
    import {BankAccountClass} from '../../class/bankAccount';
    import 'materialize-autocomplete';
    import _ from 'lodash';

    export default {
        data() {
            return {
                formType: 'insert',
                bankAccount: new BankAccountClass(),
                banks: []
            };
        },
        created() {
            if(this.$route.name == 'bank-account.update'){
                this.formType = 'update';
                this.getBankAccount(this.$route.params.id);
            }
            this.getBanks();
        },
        ready() {
            $('.materialize-select').material_select();
        },
        methods: {
            submit() {
                var data = this.bankAccount.toJSON();

                if(this.formType == 'insert') {
                    BankAccount.save({}, data).then((response) => {
                        Materialize.toast('Bank account successfully created.', 4000);

                        this.$router.go({name: 'bank-account.list'});
                    });
                }else{
                    BankAccount.update({id: this.bankAccount.id}, data).then((response) => {
                        Materialize.toast('Bank account successfully updated.', 4000);

                        this.$router.go({name: 'bank-account.list'});
                    });
                }
            },
            getBankAccount(id){
                BankAccount.get({id: id}).then((response) => {
                    this.bankAccount = new BankAccountClass(response.data.data);
                    console.log(this.bankAccount);
                });
            },
            getBanks() {
                Bank.query().then((response) => {
                    this.banks = response.data.data;
                    this.initAutocomplete();
                });
            },
            initAutocomplete() {
                let self = this;
                $(document).ready(() => {
                    $('#bank-id').materialize_autocomplete({
                        limit: 10,
                        multiple: {
                            enable: false
                        },
                        dropdown: {
                            el: '#bank-id-dropdown'
                        },
                        getData(value, callback) {
                            let banks = self.filterBandByName(value);
                            banks = banks.map((bank) => {
                                return { id: bank.id, text: bank.name }
                            });

                            callback(value, banks);
                        },
                        onSelect(item) {
                            self.bankAccount.bank_id = item.id;
                        }
                    });
                });
            },
            filterBandByName(name) {
                let banks = _.filter(this.banks, (bank) => {
                    return _.includes(bank.name.toLowerCase(), name.toLowerCase());
                });

                return banks;
            }
        }
    };
</script>