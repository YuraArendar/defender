export default {
    methods: {
        async getStructureTree() {
            return await this.$http.get(`/api/structures?locale=${this.$store.state.app.content_language}`);
        },
        async getStructure(id) {
            return await this.$http.get(`/api/structures/${id}?locale=${this.$store.state.app.content_language}`)
        },
        async updateStructure(id, request) {
            return await this.$http.patch(`/api/structures/${id}`, request)
        },
        async createNewItem(request) {
            return await this.$http.post('/api/structures', request)
        },
        async moveUp(id) {
            return await this.$http.patch(`/api/structures/up/${id}`)
        },
        async moveDown(id) {
            return await this.$http.patch(`/api/structures/down/${id}`)
        }
    }
}
