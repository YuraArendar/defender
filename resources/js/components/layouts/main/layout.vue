<template>
    <div>main app</div>
</template>

<script>
    export default {
        name: "layout",
        created() {
            if (this.$store.state.api_key === null) {
                this.$router.push('/login');
            }
        }
    }
</script>

<style scoped>

</style>
