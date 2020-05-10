import {mapMutations} from "vuex";
import {SET_ACTIVE_STRUCTURE, SET_SITE_STRUCTURE} from "../../store/app/mutations";

export default {
    data() {
        return {
            found: null
        }
    },
    methods: {
        ...mapMutations('app', [SET_SITE_STRUCTURE, SET_ACTIVE_STRUCTURE]),
        setSiteStructure(tree) {
            this[SET_SITE_STRUCTURE](tree);
        },
        setActiveStructure(id) {
            this[SET_ACTIVE_STRUCTURE](parseInt(id));
        },
        findStructureById(tree, id) {
            for (let i in tree) {
                if (id === tree[i].id) {
                    this.found = tree[i];
                } else if (tree[i].children && tree[i].children.length > 0) {
                    this.findStructureById(tree[i].children, id);
                }
            }

            return this.found;
        }
    },
    computed: {
        structure() {
            return this.$store.state.app.site_structure
        },
        activeStructure() {
            return this.$store.state.app.active_structure
        }
    }
}
