window.Vue = require('vue').default;

import MoverForm from "./components/MoverForm.vue";
import VueToastify from "vue-toastify";
import VueLoading from 'vue-loading-overlay';
import VueCollapse from 'vue2-collapse';
import EventHub from 'vue-event-hub';
import i18n from "./i18n";

Vue.use(VueToastify);
Vue.use(VueLoading);
Vue.use(VueCollapse);
Vue.use(EventHub);

const form_manager = new Vue({
    i18n,
    el: '#form_manager',
    components: {
        'form_manager': MoverForm,
    }
});

