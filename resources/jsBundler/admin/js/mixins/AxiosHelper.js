import AxiosLib from "axios";

let csrfToken = '';
const csrfSelector = document.querySelector('meta[name="csrf-token"]');

if (csrfSelector) {
    csrfToken = csrfSelector.getAttribute('content');
}

const axios = AxiosLib.create({
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': csrfToken
    },
    withCredentials: true,
});


export default {

    data() {
        return {}
    },

    methods: {

        postServerCall(url, data, headers = {}) {
            return axios.post(url, data, headers).then((response) => {
                return response;
            }).catch((error) => {
                return error.response;
            });
        },

        getServerCall(url, data) {
            return axios.get(url, {params: data}).then((response) => {
                return response;
            }).catch((error) => {
                return error.response;
            });
        },

    }
}
