<template>
    <div class="field">
        <label class="label">Description</label>
        <div class="control is-fullwidth">
            <editor api-key="tlwn6ovyd08qxy95bed6dcux29zjjx3s0uhsdp6wq037mtqd"></editor>
        </div>
        <p class="help is-danger">This is a help text</p>
    </div>
</template>

<script>
    import Editor from '@tinymce/tinymce-vue';

    export default {
        name: "a-editor",
        components: {
            Editor
        }
    }
</script>

<style scoped>

</style>
