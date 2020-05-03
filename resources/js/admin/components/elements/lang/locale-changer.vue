<template>
    <div class="navbar-item has-dropdown" :class="{'is-active': isOpen}" id="dropdown-lang-block">
        <a class="navbar-link" @click="triggerOpen" id="dropdown-lang-button">
            <img :src="`/images/flags/${$i18n.locale}.png`" alt="">
        </a>
        <div class="navbar-dropdown is-right" id="dropdown-lang-list">
            <a v-for="lang in langs" @click="onChange(lang)" v-if="lang.locale !== $i18n.locale" class="navbar-item" id="dropdown-lang-item">
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
                isOpen: false
            }
        },
        created() {
            if (this.$cookies.get('locale')) {
                this.$i18n.locale = this.$cookies.get('locale');
            }

            this.closeByClickOutside();
        },
        methods: {
            onChange(lang) {
                this.$i18n.locale = lang.locale;
                this.$cookies.set('locale', lang.locale);
                this.triggerOpen();
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
        }
    }
</script>

<style scoped>

</style>
