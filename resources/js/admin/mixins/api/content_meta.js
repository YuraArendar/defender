export default {
    methods: {
        async createMeta(request) {
            return await this.$http.post('/api/content-meta', request);
        },
        async updateMeta(id, request) {
            return await this.$http.patch(`/api/content-meta/${id}`, request)
        },
        async getMeta(id) {
            return await this.$http.get(`/api/content-meta/${id}?locale=${this.$store.state.app.content_language}`);
        }
    }
}
