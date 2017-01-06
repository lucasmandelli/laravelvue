<template>
    <form name="formSearch" method="GET" @submit="filter()">
        <div class="filter-group">
            <button class="btn waves-effect" type="submit">
                <i class="material-icons">search</i>
            </button>

            <div class="filter-wrapper">
                <input type="text" v-model="search" name="search" placeholder="Search here" />
            </div>
        </div>
    </form>
</template>

<script type="text/javascript">
    export default {
        props: {
            search: {
                required: true,
                type: String
            },
        },
        methods: {
            filter() {
                this.$emit('on-submit');
            }
        }
    };
</script>