<template>
    <div class="row">
        <div class="col s12 z-depth-2 panel">
            <h3 class="center">Bank Accounts</h3>

            <search :search.sync="search" @on-submit="filter()"></search>

            <table class="bordered striped highlight responsive-table">
                <thead>
                    <tr>
                        <th v-for="(key, header) in table.headers" :width="header.width">
                            <a href="#" @click.prevent="sortBy(key)">
                                {{ header.label }}
                                <i class="material-icons right" v-if="order.key == key">
                                    {{ order.sort == 'asc' ? 'arrow_drop_up' : 'arrow_drop_down' }}
                                </i>
                            </a>
                        </th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(index, account) in bankAccounts">
                        <td>{{ account.id }}</td>
                        <td>{{ account.name }}</td>
                        <td>{{ account.agency }}</td>
                        <td>{{ account.account }}</td>
                        <td>
                            <img :src="account.bank.data.logo" class="bank-logo responsive-img" />
                            {{ account.bank.data.name }}
                        </td>
                        <td>
                            <i class="material-icons green-text" v-if="account.default">check</i>
                        </td>
                        <td>
                            <a v-link="{ name: 'bank-account.update', params: {id: account.id} }">
                                <i class="material-icons">mode_edit</i>
                            </a>
                            <a v-link="{name: 'bank-account.delete', params: {id: account.id}}" @click.prevent="openModalDelete(account)">
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <pagination :current-page.sync="pagination.current_page"
                        :per-page="pagination.per_page"
                        :total-records="pagination.total"></pagination>

            <div class="fixed-action-btn">
                <a class="btn-floating btn-large" v-link="{name: 'bank-account.create'}">
                    <i class="large material-icons">add</i>
                </a>
            </div>
        </div>
    </div>
    <modal :modal="modal">
        <div slot="content" v-if="itemToRemove">
            <h5>Confirm...</h5>
            <p>Do you want to remove this bank account?</p>
            <div class="divider"></div>
            <p><strong>Name: </strong> {{ itemToRemove.name }}</p>
            <p><strong>Agency: </strong> {{ itemToRemove.agency }}</p>
            <p><strong>Account: </strong> {{ itemToRemove.account }}</p>
            <div class="divider"></div>
        </div>
        <div slot="footer">
            <button class="btn btn-flat red waves-effect modal-close" @click.prevent="destroy()">Delete</button>
            <button class="btn btn-flat waves-effect modal-close">Cancel</button>
        </div>
    </modal>
</template>

<script type="text/javascript">
    import {BankAccount} from '../../services/resources';
    import ModalComponent from '../../../../_default/components/Modal.vue';
    import PaginationComponent from '../Pagination.vue';
    import SearchComponent from '../../../../_default/components/Search.vue';

    export default {
        components: {
            'modal': ModalComponent,
            'pagination': PaginationComponent,
            'search': SearchComponent
        },
        data() {
            return {
                bankAccounts: [],
                itemToRemove: null,
                modal: {
                    id: 'modal-bank-account-delete'
                },
                pagination: {
                    current_page: 0,
                    per_page: 0,
                    total: 0
                },
                search: "",
                order: {
                    key: 'id',
                    sort: 'asc'
                },
                table: {
                    headers: {
                        id: {
                            label: '#',
                            width: '7%'
                        },
                        name: {
                            label: 'Name',
                            width: '30%'
                        },
                        agency: {
                            label: 'Agency',
                            width: '13%'
                        },
                        account: {
                            label: 'Account',
                            width: '13%'
                        },
                        "banks:bank_id|banks.name": {
                            label: 'Bank',
                            width: '17%'
                        },
                        'default': {
                            label: 'Default',
                            width: '5%'
                        }
                    }
                }
            }
        },
        created() {
            this.getBankAccounts();
        },
        methods: {
            openModalDelete(bankAccount) {
                this.itemToRemove = bankAccount;
                $('#' + this.modal.id).modal('open');
            },
            destroy() {
                BankAccount.delete({id: this.itemToRemove.id}).then((response) => {

                    this.bankAccounts.$remove(this.itemToRemove);
                    this.itemToRemove = null;

                    if(this.bankAccounts.length === 0 && this.pagination.current_page > 0) {
                        this.pagination.current_page--;
                    }

                    Materialize.toast('Bank account successfully deleted.', 3000);

                });
            },
            getBankAccounts() {
                BankAccount.query({
                    page: this.pagination.current_page + 1,
                    orderBy: this.order.key,
                    sortedBy: this.order.sort,
                    search: this.search,
                    include: 'bank'
                }).then((response) => {
                    this.bankAccounts = response.data.data;
                    let pagination = response.data.meta.pagination;
                    pagination.current_page--;
                    this.pagination = pagination;
                });
            },
            sortBy(key) {
                this.pagination.current_page = 0;

                this.order.key = key;
                this.order.sort = this.order.sort == 'desc' ? 'asc' : 'desc';

                this.getBankAccounts();
            },
            filter() {
                this.pagination.current_page = 0;
                this.getBankAccounts();
            }
        },
        events: {
            'pagination::changed'(newValue) {
                this.getBankAccounts();
            }
        }
    };
</script>