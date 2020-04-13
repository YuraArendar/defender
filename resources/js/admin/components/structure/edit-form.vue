<template>
    <div class="panel">
            <div class="form-group">
                <div class="field">
                    <label class="label">Name</label>
                    <div class="control is-fullwidth">
                        <input class="input" type="text" placeholder="Text input">
                    </div>
                    <p class="help is-danger">This is a help text</p>
                </div>

                <div class="field">
                    <label class="label">Template</label>
                    <div class="select">
                        <select>
                            <option>Select dropdown</option>
                            <option>With options</option>
                        </select>
                    </div>
                    <p class="help is-danger">This is a help text</p>
                </div>

                <div class="field">
                    <label class="label">Description</label>
                    <div class="control is-fullwidth">
                        <textarea class="textarea"></textarea>
                    </div>
                    <p class="help is-danger">This is a help text</p>
                </div>

            </div>


    </div>
</template>

<script>
    export default {
        name: "edit-form"
    }
</script>

<style scoped>

</style>
