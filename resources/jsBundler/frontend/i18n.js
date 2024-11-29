window.Vue = require('vue').default;
import VueI18n from 'vue-i18n';

const default_locale = window.Laravel.default_locale;
const fallback_locale = window.Laravel.fallback_locale;
const messages_locale = window.Laravel.messages_locale;

const i18n = new VueI18n({
    locale: default_locale,
    fallbackLocale: fallback_locale,
    messages: messages_locale,
});

export default i18n;