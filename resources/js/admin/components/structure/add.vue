<template>
    <div>
        <div class="panel">
            <div class="panel-heading">
                Add new item
            </div>

            <edit-form></edit-form>
        </div>
    </div>
</template>

<script>
    import EditForm from './edit-form';

    export default {
        name: "add",
        components: {
            EditForm
        }
    }
</script>

<style scoped>

</style>
