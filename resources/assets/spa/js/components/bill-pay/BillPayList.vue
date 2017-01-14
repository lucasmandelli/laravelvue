<template>
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
        <tr v-for="(index, bill) in bills">
            <td>{{ bill.id }}</td>
            <td>{{ bill.name | stringUpperLowerCase }}</td>
            <td>{{ bill.date_due }}</td>
            <td>{{ bill.value }}</td>
            <td>
                <i class="material-icons green-text" v-if="bill.done">check</i>
            </td>
            <td>
                <a v-link="{ name: 'bills-pay.update', params: {id: bill.id} }">
                    <i class="material-icons">mode_edit</i>
                </a>
                <a v-link="{name: 'bills-pay.delete', params: {id: bill.id}}" @click.prevent="openModalDelete(bill)">
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
        <a class="btn-floating btn-large" v-link="{name: 'bills-pay.create'}">
            <i class="large material-icons">add</i>
        </a>
    </div>

    <modal :modal="modal">
        <div slot="content" v-if="billToRemove">
            <h5>Confirm...</h5>
            <p>Do you want to remove this bill?</p>
            <div class="divider"></div>
            <p><strong>Name: </strong> {{ billToRemove.name }}</p>
            <p><strong>Date Due: </strong> {{ billToRemove.date_due }}</p>
            <p><strong>Value: </strong> {{ billToRemove.value }}</p>
            <div class="divider"></div>
        </div>
        <div slot="footer">
            <button class="btn btn-flat red waves-effect modal-close" @click.prevent="destroy()">Delete</button>
            <button class="btn btn-flat waves-effect modal-close">Cancel</button>
        </div>
    </modal>
</template>

<script type="text/javascript">
    import {BillsPay} from '../../services/resources';
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
                bills: [],
                billToRemove: null,
                modal: {
                    id: 'modal-delete-bill-pay'
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
                            width: '35%'
                        },
                        date_due: {
                            label: 'Date Due',
                            width: '15%'
                        },
                        value: {
                            label: 'Value',
                            width: '15%'
                        },
                        done: {
                            label: 'Paid?',
                            width: '15%'
                        }
                    }
                }
            }
        },
        created() {
            this.getBills();
        },
        methods: {
            openModalDelete(bill) {
                this.billToRemove = bill;
                $('#' + this.modal.id).modal('open');
            },
            destroy() {
                BillsPay.delete({id: this.billToRemove.id}).then((response) => {

                    this.bills.$remove(this.billToRemove);
                    this.billToRemove = null;

                    if(this.bills.length === 0 && this.pagination.current_page > 0) {
                        this.pagination.current_page--;
                    }

                    Materialize.toast('Bill successfully deleted.', 3000);

                });
            },
            getBills() {
                BillsPay.query({
                    page: this.pagination.current_page + 1,
                    orderBy: this.order.key,
                    sortedBy: this.order.sort,
                    search: this.search
                }).then((response) => {
                    this.bills = response.data.data;
                    let pagination = response.data.meta.pagination;
                    pagination.current_page--;
                    this.pagination = pagination;
                });
            },
            sortBy(key) {
                this.pagination.current_page = 0;

                this.order.key = key;
                this.order.sort = this.order.sort == 'desc' ? 'asc' : 'desc';

                this.getBills();
            },
            filter() {
                this.pagination.current_page = 0;
                this.getBills();
            }
        },
        events: {
            'pagination::changed'(newValue) {
                this.getBills();
            }
        }
    };
</script>