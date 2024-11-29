/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

import './app';

import TourDateManger from "./components/Tour/TourDateManger";
import vClickOutside from 'v-click-outside'
import VueToastify from "vue-toastify";
Vue.use(vClickOutside)
Vue.use(VueToastify);

const tour_dates_organiser = new Vue({
    el: '#tour-dates-organiser',
    components: {
        'tour-date-manager': TourDateManger,
    }
});




