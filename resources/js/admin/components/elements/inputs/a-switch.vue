<template>
    <div class="field">
        <input id="switchColorSuccess" type="checkbox" class="switch is-primary is-rtl" v-model="checked" @change="change">
        <label for="switchColorSuccess"><b>{{name}}</b></label>
    </div>
</template>

<script>
    export default {
        name: "a-switch",
        data() {
            return {
                checked: this.value
            }
        },
        props: {
            name: {
                required: true,
                type: String
            },
            value: {
                type: Boolean|Number
            }
        },
        model: {
            prop: 'value',
            event: 'change'
        },
        methods: {
            change() {
                this.$emit('change', this.checked);
            },
        },
        watch: {
            value(newValue) {
                this.checked = newValue;
            }
        }
    }
</script>

<style scoped>

</style>
