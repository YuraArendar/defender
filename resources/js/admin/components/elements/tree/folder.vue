<template>
    <li>
        <a @click.prevent="onClick" :class="{'is-active' : active}">{{folder.name}}</a>
        <ul v-if="folder.children" class="menu-list">
            <folder v-for="child in folder.children" :key="child.id" :folder="child" @click="onFolderClick"/>
        </ul>
    </li>
</template>

<script>
    import {mapMutations} from "vuex";
    import {SET_ACTIVE_STRUCTURE} from "../../../store/app/mutations";

    export default {
        name: 'folder',
        props: {
            folder: {
                required: true,
                type: Object
            },
        },
        methods: {
            ...mapMutations('app', [SET_ACTIVE_STRUCTURE]),
            onClick() {
                this[SET_ACTIVE_STRUCTURE](this.folder.id);
                this.$root.$emit('selectTreeFolder', this.folder);
            },
            onFolderClick(event) {
                this.$emit('onFolderClick', event);
            }
        },
        computed: {
            active() {
                return this.$store.state.app.active_structure === this.folder.id
            }
        }
    }
</script>

<style scoped>

</style>
