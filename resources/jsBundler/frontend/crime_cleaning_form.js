window.Vue = require('vue').default;

import CrimeCleaningForm from "./components/CrimeCleaningForm.vue";
import VueToastify from "vue-toastify";
import VueLoading from 'vue-loading-overlay';
import i18n from "./i18n";

Vue.use(VueToastify);
Vue.use(VueLoading);

const form_manager = new Vue({
    i18n,
    el: '#form_manager',
    components: {
        'form_manager': CrimeCleaningForm,
    }
});

