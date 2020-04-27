export default {
    methods: {
        async getStructureTree() {
            return await this.$http.get('/api/structures');
        },
        async getStructure(id) {
            return await this.$http.get(`/api/structures/${id}`)
        }
    }
}
