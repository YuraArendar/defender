<template>
    <li>
        <a @click.prevent="onClick" :class="{'is-active' : active}">
            <span>{{folder.name}}</span>
            <span v-if="isSortable" class="is-pulled-right up-down-container">
                <button v-if="order > 0" class="button is-small is-success" @click.prevent.stop="up">
                    <font-awesome-icon icon="angle-up"/>
                </button>
                <button v-if="order < count -1" class="button is-small is-primary" @click.prevent.stop="down">
                    <font-awesome-icon icon="angle-down"/>
                </button>
            </span>
        </a>
        <ul v-if="hasChildren" class="menu-list">
            <folder v-for="(child, index) in folder.children" :key="child.id" :order="index"
                    :count="folder.children.length" :folder="child"/>
        </ul>
    </li>
</template>

<script>
    export default {
        name: 'folder',
        props: {
            folder: {
                required: true,
                type: Object
            },
            order: {
                required: true,
                type: Number
            },
            count: {
                required: true,
                type: Number
            }
        },
        methods: {
            onClick() {
                this.getTreeComponent().$data.selected = this.folder.id;
                this.getTreeComponent().$emit('click', this.folder);
            },
            getTreeComponent() {
                let element = this.$parent;

                while (true) {
                    if (element.$options._componentTag === 'tree') {
                        return element;
                    }

                    element = element.$parent;
                }
            },
            up() {
                this.getTreeComponent().$emit('up', this.folder)
            },
            down() {
                this.getTreeComponent().$emit('down', this.folder)
            }
        },
        computed: {
            active() {
                return this.selected === this.folder.id
            },
            selected() {
                return this.getTreeComponent().$data.selected_node;
            },
            isSortable() {
                return this.getTreeComponent().$props.sortable && this.count > 0
            },
            hasChildren() {
                return this.folder.children && this.folder.children.length > 0
            }
        }
    }
</script>

<style scoped>
    .up-down-container {
        margin-top: -5px;
    }
</style>
