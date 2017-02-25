<template>
    <div class="row">
        <div class="col s12 z-depth-2 panel">
            <h3 class="center">Categories</h3>

            <div class="container">
                <div class="divider"></div>
            </div>

            <category-list :categories="categories"></category-list>

            <category-create :modal-options="modalOptions" :category.sync="categorySave"
                             :cp-options="cpOptions" @save-category="saveCategory">
                <span slot="title">{{ title }}</span>
            </category-create>

            <div class="fixed-action-btn">
                <button class="btn-floating btn-large" @click="modalNew(null)">
                    <i class="large material-icons">add</i>
                </button>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    import {Category} from '../../services/resources';
    import CategoryListComponent from './CategoryList.vue';
    import CategoryCreateComponent from './CategoryCreate.vue';
    import {CategoryFormat, CategoryService} from '../../services/category-nsm';

    export default {
        components: {
            'category-list': CategoryListComponent,
            'category-create': CategoryCreateComponent
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
                parent: null,
                title: '',
                modalOptions: {
                    id: 'modal-category-save'
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
                Category.query().then(response => {
                    this.categories = response.data.data;
                    this.formatCategories();
                });
            },
            saveCategory() {
                CategoryService.new(this.categorySave, this.parent, this.categories).then(response => {
                    console.log(response);
                    Materialize.toast('Category successfully created.', 4000);
                    this.resetScope();
                })
            },
            modalNew(category) {
                this.title = 'New Category'
                this.categorySave = {
                    id: 0,
                    name: '',
                    parent_id: (category === null) ? null : category.id
                };
                this.parent = category;
                $('#' + this.modalOptions.id).modal('open');
            },
            modalEdit(category) {
                this.categorySave = category;
                $('#' + this.modalOptions.id).modal('open')
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
                this.parent = null;
                this.formatCategories();
            }
        },
        events: {
            'category-new'(category) {
                this.modalNew(category);
            },
            'category-edit'(category) {

            }
        }
    };
</script>