export default {
    methods: {
        async getStructureTree() {
            return await this.$http.get('/api/structures');
        },
        async getStructure(id) {
            console.log('mixin id = ', `/api/structures/${id}`);
            return await this.$http.get(`/api/structures/${id}`)
        }
    }
}
