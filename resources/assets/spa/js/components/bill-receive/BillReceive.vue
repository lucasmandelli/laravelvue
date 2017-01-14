<template>
    <div class="row">
        <div class="col s12 z-depth-2 panel">
            <h3 class="center">{{ title }}</h3>

            <div class="container">
                <div class="row">
                    <div class="col s6">
                        <div class="card z-depth-2">
                            <div class="card-content">
                                <p class="card-title">
                                    <i class="material-icons">account_balance</i>
                                </p>
                                <h5 :class="{'grey-text': status === false, 'green-text': status === 0, 'red-text': status > 0}">{{ status | statusGeneralReceive }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col s6">
                        <div class="card z-depth-2">
                            <div class="card-content">
                                <p class="card-title">
                                    <i class="material-icons">payment</i>
                                </p>
                                <h5>{{ total }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="divider"></div>
            </div>

            <router-view></router-view>
        </div>
    </div>
</template>

<script type="text/javascript">
    import {BillsReceived} from '../../services/resources';

    export default {
        data() {
            return {
                title: "Bills Received",
                status: false,
                total: 0
            };
        },
        created() {
            this.updateStatus();
            this.updateTotal();
        },
        methods: {
            updateStatus() {
                BillsReceived.status().then((response) => {
                    this.status = response.data.status;
                });
            },
            updateTotal() {
                BillsReceived.total().then((response) => {
                    this.total = response.data.total;
                });
            }
        },
        events: {
            'change-info'() {
                this.updateStatus();
                this.updateTotal();
            }
        }
    };
</script>