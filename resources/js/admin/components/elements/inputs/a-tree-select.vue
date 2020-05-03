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
                <span class="is-small clear-input" @click="clearSelection">
                    <font-awesome-icon icon="times" size="lg"></font-awesome-icon>
                </span>
            </div>
            <div class="dropdown-menu" id="dropdown-tree-menu">
                <div class="dropdown-content dropdown-scrollable" id="dropdown-tree-scrollable">
                    <tree ref="tree" :tree="tree" :selected="selectedItemId" @click="onSelect" id="dropdown-tree-element"></tree>
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
                selectedItemId: null,
                selectedItem: null,
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
            value: {
                required: false
            }
        },
        model: {
            prop: 'value',
            event: 'change'
        },
        created() {
            this.selectedItemId = this.value;
            this.closeByClickOutside()
        },
        methods: {
            triggerDropdown() {
                this.isOpen = !this.isOpen
            },
            onSelect(item) {
                this.selectedItemId = item.id;
                this.text = item.name ? item.name : item.id;
                this.triggerDropdown();
                this.$emit('change', item.id);
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
            },
            clearSelection() {
                this.text = this.defaultText;
                this.$emit('change', null);
            },
            searchById(list, id) {
                if (list) {
                    for (let i in list) {
                        if (list[i].children && list[i].children.length > 0) {
                            if (this.searchById(list[i].children, id)) {
                                return true;
                            }
                        }

                        if (list[i].id === id) {
                            this.selectedItem = list[i];
                            return true;
                        }
                    }
                }

                this.selectedItem = null;
            },
        },
        watch: {
            tree(newValue) {
                this.for_render = newValue;
            },
            error(text) {
                this.errorText = text;
            },
            value(newValue) {
                this.selectedItemId = newValue;
                this.searchById(this.tree, parseInt(newValue));
                if (this.selectedItem === null) {
                    this.text = this.defaultText;
                } else {
                    this.text = this.selectedItem.name ? this.selectedItem.name : this.selectedItem.id;
                }
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

    .clear-input {
        color: rgb(204, 84, 84);
        display: inline-block;
        margin: 7px 0 0 5px;
        cursor: pointer;
    }
</style>
