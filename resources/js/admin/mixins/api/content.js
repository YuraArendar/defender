export default {
    methods: {
        async addNewArticle(request) {
            return await this.$http.post('/api/content', request);
        },
        async getContentList(structureId, orderBy, way) {
            return await this.$http.get(`/api/content?locale=${this.$store.state.app.content_language}` +
                `&structure_id=${structureId}&orderBy=${orderBy}&way=${way}`)
        },
        async getPaginatedContentList(structureId, orderBy, way, page, perPage) {
            return await this.$http.get(`/api/content/${structureId}/pagination?locale=${this.$store.state.app.content_language}` +
                `&orderBy=${orderBy}&way=${way}&page=${page}&perPage=${perPage}`)
        },
        async updateActiveStatus(contentId, active) {
            return await this.$http.patch(`/api/content/${contentId}/active`, {active})
        },
        async up(contentId, structureId) {
            return await this.$http.patch(`/api/content/${contentId}/${structureId}/up`, {locale: this.$store.state.app.content_language})
        },
        async down(contentId, structureId) {
            return await this.$http.patch(`/api/content/${contentId}/${structureId}/down`, {locale: this.$store.state.app.content_language})
        }
    }
}
