<template>
    <div class="navbar-item has-dropdown" :class="{'is-active': isOpen}" id="dropdown-lang-block">
        <a class="navbar-link" @click="triggerOpen" id="dropdown-lang-button">
            <img :src="`/images/flags/${selected}.png`" alt="">
        </a>
        <div class="navbar-dropdown is-right" id="dropdown-lang-list">
            <a v-for="lang in langs" @click="onChange(lang)" v-if="lang.locale !== selected" class="navbar-item" id="dropdown-lang-item">
                <img :src="`/images/flags/${lang.locale}.png`" alt="">&nbsp;{{lang.name}}
            </a>
        </div>
    </div>
</template>

<script>
    export default {
        name: "locale-changer",
        data() {
            return {
                langs: [{locale: 'en', name: 'English'}, {locale: 'ru', name: 'Русский'}, {locale: 'uk', name: 'Українська'}],
                isOpen: false,
                selected: 'en',
            }
        },
        created() {
            this.selected = this.locale;
            this.closeByClickOutside();
        },
        props: {
            locale: {
                type: String
            }
        },
        model: {
            prop: 'locale',
            event: 'change'
        },
        methods: {
            onChange(lang) {
                this.triggerOpen();
                this.selected = lang.locale;
                this.$emit('change', lang.locale);
            },
            triggerOpen() {
                this.isOpen = !this.isOpen;
            },
            closeByClickOutside() {
                document.addEventListener('click', e => {
                    if (e.target.id.indexOf('dropdown-lang') === -1) {
                        this.isOpen = false;
                    }
                })
            },
        },
        watch: {
            locale(newLocale) {
                this.selected = newLocale;
            }
        }
    }
</script>

<style scoped>

</style>
