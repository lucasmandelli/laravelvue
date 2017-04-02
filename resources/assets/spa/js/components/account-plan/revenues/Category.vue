<template>
    <div class="row">
        <div class="col s12 z-depth-2 panel">
            <h3 class="center">Account Plans</h3>

            <div class="container">
                <div class="divider"></div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col offset-s4 s4">
                        <ul class="tabs">
                            <li class="tab col s6">
                                <a v-link="{name: 'account-plan-revenues'}" class="active" >Revenues</a>
                            </li>
                            <li class="tab col s6">
                                <a v-link="{name: 'account-plan-expenses'}" >Expenses</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <category-list :categories="categories"></category-list>

            <category-create :modal-options="modalOptionsSave" :category.sync="categorySave"
                             :cp-options="cpOptions" @save-category="saveCategory">
                <span slot="title">{{ title }}</span>
            </category-create>

            <modal :modal="modalOptionsDelete">
                <div slot="content" v-if="categoryDelete">

                    <h5>Confirm...</h5>

                    <p>Do you want to remove this category?</p>

                    <div class="divider"></div>
                    <p><strong>Name: </strong> {{ categoryDelete.name }}</p>
                    <div class="divider"></div>

                </div>

                <div slot="footer">
                    <button class="btn btn-flat red waves-effect modal-close modal-action" @click="destroy()" >Delete</button>
                    <span class="btn btn-flat waves-effect modal-close" type="button">Cancel</span>
                </div>
            </modal>

            <div class="fixed-action-btn">
                <button class="btn-floating btn-large" @click="modalNew(null)">
                    <i class="large material-icons">add</i>
                </button>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import {AccountPlanRevenues} from '../../../services/resources';
    import CategoryListComponent from './CategoryList.vue';
    import CategoryCreateComponent from './CategoryCreate.vue';
    import {CategoryFormat, CategoryService} from '../../../services/account-plan-revenues-nsm';
    import ModalComponent from '../../../../../_default/components/Modal.vue';

    export default {
        components: {
            'category-list': CategoryListComponent,
            'category-create': CategoryCreateComponent,
            'modal': ModalComponent
        },
        data() {
            return {
                categories: [],
                categoriesFormatted: [],
                categorySave: {
                    id: 0,
                    name: '',
                    parent_id: 0
                },
                categoryDelete: null,
                category: null,
                parent: null,
                title: '',
                modalOptionsSave: {
                    id: 'modal-category-save'
                },
                modalOptionsDelete: {
                    id: 'modal-category-delete'
                }
            }
        },
        computed: {
            cpOptions() {
                return {
                    data: this.categoriesFormatted,
                    templateResult(category) {
                        let margin = '&nbsp;'.repeat(category.level * 6);
                        let text = category.hasChildren ? '<strong>'+category.text+'</strong>' : category.text;

                        return margin + text;
                    },
                    escapeMarkup(markup) { return markup; }
                }
            }
        },
        created() {
            this.getCategories();
        },
        methods: {
            getCategories() {
                AccountPlanRevenues.query().then(response => {
                    this.categories = response.data.data;
                    this.formatCategories();
                });
            },
            saveCategory() {
                CategoryService.save(this.categorySave, this.parent, this.categories, this.category).then(response => {

                    if(this.categorySave.id === 0) {
                        Materialize.toast('Category successfully created.', 4000);
                    } else {
                        Materialize.toast('Category successfully updated.', 4000);
                    }

                    this.resetScope();
                });
            },
            destroy() {
                CategoryService.destroy(this.categoryDelete, this.parent, this.categories).then(response => {
                    Materialize.toast('Category successfully deleted.', 4000);

                    this.resetScope();
                });
            },
            modalNew(category) {
                this.title = 'New Category';
                this.categorySave = {
                    id: 0,
                    name: '',
                    parent_id: (category === null) ? null : category.id
                };
                this.parent = category;
                $('#' + this.modalOptionsSave.id).modal('open');
            },
            modalEdit(category, parent) {
                this.title = 'Edit Category';
                this.categorySave = {
                    id: category.id,
                    name: category.name,
                    parent_id: category.parent_id
                };
                this.category = category;
                this.parent = parent;
                $('#' + this.modalOptionsSave.id).modal('open');
            },
            modalDelete(category, parent) {
                this.categoryDelete = category;
                this.parent = parent;
                $('#' + this.modalOptionsDelete.id).modal('open');
            },
            formatCategories() {
                this.categoriesFormatted = CategoryFormat.getCategoriesFormatted(this.categories);
            },
            resetScope() {
                this.categorySave = {
                    id: 0,
                    name: '',
                    parent_id: 0
                };
                this.categoryDelete = null;
                this.category = null;
                this.parent = null;
                this.formatCategories();
            }
        },
        events: {
            'category-new'(category) {
                this.modalNew(category);
            },
            'category-edit'(category, parent) {
                this.modalEdit(category, parent);
            },
            'category-delete'(category, parent) {
                this.modalDelete(category, parent);
            }
        }
    };
</script>