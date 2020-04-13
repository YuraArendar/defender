
export default {
    methods: {
        async getUserInfo() {
            return await this.$http.post('/api/user');
        }
    }
}
