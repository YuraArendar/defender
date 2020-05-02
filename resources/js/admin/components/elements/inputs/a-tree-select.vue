<template>
    <div class="field">
        <label class="label">{{name}}</label>

        <div :class="{dropdown: true, 'is-active': isOpen}" id="dropdown-tree-block">
            <div class="dropdown-trigger" id="dropdown-tree-input">
                <button class="button" id="dropdown-tree-trigger" aria-haspopup="true" aria-controls="dropdown-tree-menu" @click="click">
                    <span id="dropdown-tree-text-inside">{{text}}</span>
                    <span class="icon is-small" id="dropdown-tree-icon">
                         <font-awesome-icon icon="angle-down" id="dropdown-tree-arrow"/>
                    </span>
                </button>
            </div>
            <div class="dropdown-menu" id="dropdown-tree-menu">
                <div class="dropdown-content dropdown-scrollable" id="dropdown-tree-scrollable">
                    <tree ref="tree" :tree="tree" :selected="selected" @click="onSelect" id="dropdown-tree-element"></tree>
                </div>
            </div>
        </div>

        <p v-if="errorText.length > 0" class="help is-danger">{{errorText}}</p>
    </div>

</template>

<script>
    import tree from '../tree/tree';

    export default {
        name: "a-tree-select",
        data() {
            return {
                isOpen: false,
                for_render: null,
                text: this.defaultText,
                errorText: '',
            }
        },
        props: {
            tree: {
                required: true,
            },
            selected: {
                required: false
            },
            name: {
                type: String,
                required: true
            },
            defaultText: {
                type: String,
                default: 'Please select'
            },
            error: {
                required: false,
                type: String
            },
        },
        created() {
            this.closeByClickOutside()
        },
        methods: {
            triggerDropdown() {
                this.isOpen = !this.isOpen
            },
            onSelect() {
                this.triggerDropdown();
            },
            closeByClickOutside() {
                document.addEventListener('click', e => {
                    if (e.target.id.indexOf('dropdown-tree') === -1) {
                        this.isOpen = false;
                    }
                })
            },
            click(e) {
                this.$emit('onfocus', e);
                this.triggerDropdown();
            }
        },
        watch: {
            tree(newValue) {
                this.for_render = newValue;
            },
            error(text) {
                this.errorText = text;
            },
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
