export default {
    methods: {
        async getStructureTree() {
            return await this.$http.get('/api/structures');
        },
        async getStructure(id) {
            return await this.$http.get(`/api/structures/${id}`)
        },
        async updateStructure(id, request) {
            return await this.$http.patch(`/api/structures/${id}`, request)
        },
        async createNewItem(request) {
            return await this.$http.post('/api/structures', request)
        }
    }
}
