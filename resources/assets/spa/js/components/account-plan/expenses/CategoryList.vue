<template>

    <ul class="category-list">
        <li v-for="(index, category) in categories" class="category-child">
            <div class="valign-wrapper">
                <a :data-activates="dropdownId(category)" href="#" class="category-icon"
                   :class="{'green-text': category.children.data.length > 0, 'grey-text': !category.children.data.length}">
                    <i class="material-icons">{{{ categoryIcon(category) }}}</i>
                </a>

                <ul :id="dropdownId(category)" class="dropdown-content">
                    <li>
                        <a href="#" @click.prevent="categoryNew(category)">Add</a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="categoryEdit(category)">Edit</a>
                    </li>
                    <li>
                        <a href="#" @click.prevent="categoryDelete(category)">Destroy</a>
                    </li>
                </ul>

                <span class="valign">{{{ categoryText(category) }}}</span>
            </div>
            <category-list :categories="category.children.data" :parent="category" ></category-list>
        </li>
    </ul>

</template>

<script type="text/javascript">
    export default {
        name: 'category-list',
        props: {
            categories: {
                type: Array,
                required: true
            },
            parent: {
                type: Object,
                required: false,
                'default'() {
                    return null;
                }
            }
        },
        watch: {
            categories: {
                handler(categories) {
                    $(".category-child > div > a").dropdown({
                        hover: true,
                        inDuration: 300,
                        outDuration: 300,
                        belowOrigin: true
                    });
                },
                deep: true
            }
        },
        methods: {
            categoryText(category) {
                return (category.children.data.length > 0) ? '<strong>' +  category.name + '</strong>' : category.name;
            },
            categoryIcon(category) {
                return (category.children.data.length > 0) ? 'folder' : 'label';
            },
            dropdownId(category) {
                return 'category-dropdown-' + category.id;
            },
            categoryNew(category) {
                this.$dispatch('category-new', category);
            },
            categoryEdit(category) {
                this.$dispatch('category-edit', category, this.parent);
            },
            categoryDelete(category) {
                this.$dispatch('category-delete', category, this.parent);
            }
        }
    }
</script>