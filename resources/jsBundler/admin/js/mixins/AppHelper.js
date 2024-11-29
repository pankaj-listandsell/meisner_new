import {isArray} from "lodash";

export default {

    methods: {

        asset(path) {
            return path;
        },

        url(path) {
            return path;
        },

        route(path) {
            return path;
        },

        trimText(string, trim) {
            if (typeof string != 'string') {
                return '';
            }

            return string.replace(trim, '');
        },

        __has(object, key) {
            return object.hasOwnProperty(key);
        },

        __is_Object(object) {
            return typeof object === 'object' && !Array.isArray(object) && object !== null;
        },

        __get(object, key, default_value = '') {
            return this.__has(object, key) ? object[key] : default_value;
        },



        getDateInGlobalFormat(stringDate = '') {

            let date = new Date();

            if (stringDate !== '') {
                date = new Date(stringDate);
            }

            let currentDay= String(date.getDate()).padStart(2, '0');

            let currentMonth = String(date.getMonth()+1).padStart(2,"0");

            let currentYear = date.getFullYear();

            return `${currentYear}-${currentMonth}-${currentDay}`;
        },

        generateRandomId(length) {
            let randomId = '';
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                randomId += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            return randomId;
        },

        generateRandomIdForForm(length = 15) {
            let randomId = '';
            let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let charactersLength = characters.length;
            for (let i = 0; i < length; i++) {
                randomId += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            return randomId;
        },

        scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        },

        truncateString(text, length = 20, suffix = '..') {
            let newText = '';
            if (text != null) {
                newText = text + '';
            }

            if (newText.length > length) {
                return newText.substring(0, length) + suffix;
            } else {
                return newText;
            }
        },

        getStringLength(text) {
            let newText = '';

            if (text != null) {
                newText = text + '';
            }

            return newText.length;
        },

        getMemberTypeName(type) {
            switch (type) {
                case 'infant':
                    return 'Infants';
                case 'child':
                    return 'Children';
                default:
                    return 'Adults';
            }
        },

        getPriceFormat(amount) {
            return this.numberFormat(amount, 2);
        },

        getReadableDepositType(type) {
            return type === this.getFullPaymentType() ? 'Full Payment' : 'Partial Payment';
        },

        isFullPaymentType(type) {
            return this.getFullPaymentType() === type;
        },

        isPartialPaymentType(type) {
            return this.getPartialPaymentType() === type;
        },

        getFullPaymentType() {
            return 'full_payment';
        },

        getPartialPaymentType() {
            return 'partial_payment';
        },

        inArray(needle, haystack) {
            let length = haystack.length;
            for(let i = 0; i < length; i++) {
                if(haystack[i] == needle) return true;
            }
            return false;
        },

        numberFormat(number, decimals, dec_point = '.', thousands_sep = ',') {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            let n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    let k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        },

        trans(key) {
            return this.$t(key); //this.$t(key)
        },

        isEmptyObject(obj) {
            return Object.keys(obj).length === 0 && obj.constructor === Object;
        },

        getFormData(form, honeypot = {}) {
            let formData = new FormData();

            for (const key of Object.keys(form)) {
                if (isArray(form[key])) {
                    form[key].forEach(val => {
                        formData.append(`${key}[]`, val);
                    });
                } else {
                    formData.append(key, form[key]);
                }
            }

            if (this.__has(honeypot, 'enabled')) {
                if (honeypot.enabled) {
                    formData.append(honeypot.nameFieldName, '');
                    formData.append(honeypot.validFromFieldName, honeypot.encryptedValidFrom);
                }
            }

            return formData;
        },

        getHoneyPotData(config) {
            if (this.__has(config, 'honeypot')) {
                return this.config.honeypot;
            }
            return {};
        }

    },

};
