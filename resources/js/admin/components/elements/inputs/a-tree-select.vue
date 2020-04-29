<template>
    <div class="field">
        <label class="label">Parent id</label>

        <div :class="{dropdown: true, 'is-active': isOpen}">
            <div class="dropdown-trigger">
                <button class="button" aria-haspopup="true" aria-controls="dropdown-tree-menu" @click="triggerDropdown">
                    <span>Click me</span>
                    <span class="icon is-small">
                         <font-awesome-icon icon="angle-down"/>
                    </span>
                </button>
            </div>
            <div class="dropdown-menu" id="dropdown-tree-menu" role="menu">
                <div class="dropdown-content dropdown-scrollable">
                    <tree :tree="tree" @click="onSelect"></tree>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import tree from '../tree/tree';

    export default {
        name: "a-tree-select",
        data() {
            return {
                isOpen: false,
                for_render: null
            }
        },
        props: {
            tree: {
                required: true,
            },
        },
        methods: {
            triggerDropdown() {
                this.isOpen = !this.isOpen
            },
            onSelect(item) {
                this.triggerDropdown();
                console.log(item)
            }
        },
        watch: {
            tree(tree) {
                this.for_render = tree;
            }
        },
        components: {
            tree
        }
    }
</script>

<style scoped>
    .dropdown-scrollable {
        overflow-x: hidden;
        overflow-y: auto;
        max-height: 250px;
    }
</style>
