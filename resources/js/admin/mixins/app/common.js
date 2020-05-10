export default {
    methods: {
        errors(errorsList) {
            for (let name in errorsList) {
                if (this.inputErrors[name] !== undefined) {
                    this.$set(this.inputErrors, name, errorsList[name][0]);
                }
            }
        },
        values(form) {
            for (let name in form) {
                if (this.form[name] !== undefined) {
                    this.$set(this.form, name, form[name])
                }
            }
        },
    },
    computed: {
        content_language() {
            return this.$store.state.app.content_language;
        }
    }
}
