/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

import './app.js';

import TourAvailability from "./components/Tour/TourAvailability";
import VueToastify from "vue-toastify";
Vue.use(VueToastify);

const tour_dates_organiser = new Vue({
    el: '#availability-organiser',
    components: {
        'tour-availability': TourAvailability,
    }
});


