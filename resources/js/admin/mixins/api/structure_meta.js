export default {
    methods: {
        async createMeta(request) {
            return await this.$http.post('/api/structures-meta', request);
        },
        async updateMeta(id, request) {
            return await this.$http.patch(`/api/structures-meta/${id}`, request)
        },
        async getMeta(id) {
            return await this.$http.get(`/api/structures-meta/${id}?locale=${this.$store.state.app.content_language}`);
        }
    }
}
