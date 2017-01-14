<template>
    <div class="container">
        <div class="row">
            <div class="col s12 z-depth-2 panel">
                <div class="row valign-wrapper">
                    <div class="col s6">
                        <h5 v-if="formType == 'insert'">Bill Create</h5>
                        <h5 v-else>Bill Edit</h5>
                    </div>
                    <div class="col s6">
                        <div class="valign">
                            <a class="btn waves-effect right" v-link="{name: 'bills-pay.list'}">
                                <i class="material-icons">arrow_back</i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="divider"></div>
                <form name="formBillCreate" @submit.prevent="submit">
                    <div class="row">
                        <div class="input-field col s6">
                            <label for="name" class="active">Name</label>
                            <select id="name" class="materialize-select browser-default" v-model="bill.name">
                                <option value="" disabled selected>Select...</option>
                                <option v-for="name in names" :value="name">{{ name | stringUpperLowerCase }}</option>
                            </select>
                        </div>
                        <div class="input-field col s6">
                            <label for="date_due" class="active">Date Due</label>
                            <input type="text" id="date_due" v-model="bill.date_due | dateFormat 'pt-BR'" placeholder="Type the date" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <label for="value" class="active">Value</label>
                            <input type="text" id="value" v-model="bill.value" >
                        </div>
                        <div class="input-field col s6">
                            <input type="checkbox" id="done" v-model="bill.done" >
                            <label for="done">Paid?</label>
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
    import {BillsPay} from '../../services/resources';
    import {BillClass as ClassBillPay} from '../../class/bill';

    const namesPay = [
        'energy bill',
        'water bill',
        'phone bill',
        'market',
        'credit card',
        'loan',
        'fuel'
    ];

    export default {
        data() {
            return {
                formType: 'insert',
                names: namesPay,
                bill: new ClassBillPay()
            };
        },
        created() {
            if(this.$route.name == 'bills-pay.update'){
                this.formType = 'update';
                this.getBill(this.$route.params.id);
            }
        },
        ready() {
            $('.materialize-select').material_select();
        },
        methods: {
            submit() {
                var data = this.bill.toJSON();

                if(this.formType == 'insert') {
                    BillsPay.save({}, data).then((response) => {
                        Materialize.toast('Bill successfully created.', 4000);

                        this.$router.go({name: 'bills-pay.list'});
                    });
                }else{
                    BillsPay.update({id: this.bill.id}, data).then((response) => {
                        Materialize.toast('Bill successfully updated.', 4000);

                        this.$router.go({name: 'bills-pay.list'});
                    });
                }
            },
            getBill(id){
                BillsPay.get({id: id}).then((response) => {
                    this.bill = new ClassBillPay(response.data.data);
                });
            }
        }
    };
</script>