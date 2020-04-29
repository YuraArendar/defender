import {mapMutations} from "vuex";
import {SET_ACTIVE_STRUCTURE, SET_SITE_STRUCTURE} from "../../store/app/mutations";

export default {
    methods: {
        ...mapMutations('app', [SET_SITE_STRUCTURE, SET_ACTIVE_STRUCTURE]),
        setSiteStructure(tree) {
            this[SET_SITE_STRUCTURE](tree);
        },
        setActiveStructure(id) {
            this[SET_ACTIVE_STRUCTURE](parseInt(id));
        }
    },
    computed: {
        structure() {
            return this.$store.state.app.site_structure
        }
    }
}
