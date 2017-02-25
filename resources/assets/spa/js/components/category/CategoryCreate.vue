<template>

    <div>
        <form name="form" method="POST" @submit="submit">
            <modal :modal="modalOptions">
                <div slot="content">
                    <h5>
                        <slot name="title"></slot>
                    </h5>

                    <div class="row">
                        <div class="input-field col s12">
                            <label class="active">Nome</label>
                            <input type="text" v-model="category.name" placeholder="Type the category name" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <select-material :options="cpOptions" :selected.sync="category.parent_id" ></select-material>
                            <label class="active">Category root</label>
                        </div>
                    </div>
                </div>

                <div slot="footer">
                    <button class="btn btn-flat green waves-effect modal-close" type="submit" >Save</button>
                    <span class="btn btn-flat waves-effect modal-close">Cancel</span>
                </div>
            </modal>
        </form>
    </div>

</template>

<script type="text/javascript">
    import ModalComponent from '../../../../_default/components/Modal.vue';
    import SelectMaterialComponent from '../../../../_default/components/SelectMaterial.vue';

    export default {
        components: {
            'modal': ModalComponent,
            'select-material': SelectMaterialComponent
        },
        props: {
            category: {
                type: Object,
                required: true
            },
            modalOptions: {
                type: Object,
                required: true
            },
            cpOptions: {
                type: Object,
                required: true
            }
        },
        methods: {
            submit() {
                this.$emit('save-category');
            }
        }
    }
</script>