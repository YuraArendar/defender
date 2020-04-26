<template>
    <div class="field">
        <label class="label">{{name}}</label>
        <div class="select" @change.prevent="onSelect" @focusin="errorText = ''">
            <select>
                <option v-for="option in options" :selected="value === option.value" :value="option.value">
                    {{option.name}}
                </option>
            </select>
        </div>
        <p v-if="errorText.length > 0" class="help is-danger">{{errorText}}</p>
    </div>
</template>

<script>
    export default {
        name: "a-select",
        data() {
            return {
                errorText: ''
            }
        },
        props: {
            name: {
                required: true,
                type: String
            },
            options: {
                required: true,
                type: Array
            },
            error: {
                required: false,
                type: String
            },
            value: {}
        },
        model: {
            prop: 'value',
            event: 'change'
        },
        methods: {
            onSelect(event) {
                this.$emit('change', event.target.value)
            }
        },
        watch: {
            error(text) {
                this.errorText = text;
            }
        }
    }
</script>
