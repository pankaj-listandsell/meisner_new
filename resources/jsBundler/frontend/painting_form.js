window.Vue = require('vue').default;

import PaintingForm from "./components/PaintingForm.vue";
import VueToastify from "vue-toastify";
import VueLoading from 'vue-loading-overlay';
import i18n from "./i18n";

Vue.use(VueToastify);
Vue.use(VueLoading);

const form_manager = new Vue({
    i18n,
    el: '#form_manager',
    components: {
        'form_manager': PaintingForm,
    }
});

