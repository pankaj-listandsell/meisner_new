/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

import './app';

import EditBookingModal from "./components/Tour/EditBookingModal.vue";
import VueLoading from 'vue-loading-overlay';
import vClickOutside from 'v-click-outside'
import VueToastify from "vue-toastify";
import EventHub from 'vue-event-hub';
Vue.use(vClickOutside);
Vue.use(VueToastify);
Vue.use(VueLoading);
Vue.use(EventHub);

const booking_manager = new Vue({
    el: '#booking-manager',
    components: {
        'edit-booking': EditBookingModal,
    },
    created() {
        this.$eventHub.on('BOOKING_UPDATED', () => {
            window.location.href = window.Laravel.getBookingListingPage;
        });
    },

});
