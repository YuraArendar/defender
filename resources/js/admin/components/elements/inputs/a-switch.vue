<template>
    <div class="field">
        <input type="checkbox" class="switch is-primary is-rtl" v-model="checked" @click="change">
        <label @click="change"><b>{{name}}</b></label>
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
                this.checked = !this.checked;
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
