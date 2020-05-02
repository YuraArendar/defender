<template>
    <div class="field">
        <label class="label">{{name}}</label>
        <div class="control is-fullwidth">
            <textarea class="textarea" v-model="text" @change="onChange" @focusin="onFocus"></textarea>
        </div>
        <p v-if="errorText.length > 0" class="help is-danger">{{errorText}}</p>
    </div>
</template>

<script>
    export default {
        name: "a-textarea",
        data() {
            return {
                errorText: '',
                text: this.value,
            }
        },
        props: {
            type: {
                type: String,
                required: false,
                default: 'text'
            },
            name: {
                required: true,
                type: String
            },
            error: {
                required: false,
                type: String
            },
            value: {
                required: false,
            }
        },
        model: {
            prop: 'value',
            event: 'change'
        },
        methods: {
            onChange() {
                this.$emit('change', this.text)
            },
            onFocus(event) {
                this.$emit('onfocus', event)
            }
        },
        watch: {
            error(text) {
                this.errorText = text;
            },
        }
    }
</script>

<style scoped>

</style>
