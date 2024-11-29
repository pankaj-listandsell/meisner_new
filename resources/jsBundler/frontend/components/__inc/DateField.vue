<template>
    <div class="date-field">
        <VueJsDatepicker
                input-class="form-control"
                :open-date='new Date()'
                :name="fieldName"
                :value="fieldValue"
                format="dd.MM.yyyy"
                @selected="setPreferredDate"
                :disabled-dates="{to: new Date(Date.now() - 864e5), dates: []}"
                :placeholder="getPlaceholder()"
                :language="datePickerLang"
        ></VueJsDatepicker>

        <ErrorBox :error="error"></ErrorBox>
    </div>
</template>

<script>
import AppHelper from "../../../admin/js/mixins/AppHelper";
import VueJsDatepicker from "vuejs-datepicker";
import locale_translations_de from "../../locale_translations_de";
import locale_translations_en from "../../locale_translations_en";
import ErrorBox from "./ErrorBox.vue";

export default {

    props: {
        config: {
            required: true,
        },
        schema: {
            required: true,
        },
        fieldName: {
            required: true
        },
        error: {
            type: Object,
            require: true,
        },
        defaultValue: {
            default: '',
        }
    },

    components: {
        ErrorBox,
        VueJsDatepicker
    },

    mixins: [AppHelper],

    data() {
        return {
            datePickerLang: null,
            fieldValue: new Date(),
        };
    },

    async created() {
        this.datePickerLang = this.config.lang === 'de' ? locale_translations_de : locale_translations_en;
        this.fieldValue = this.defaultValue ? new Date(this.defaultValue) : '';
    },

    mounted() {

    },


    methods: {

        setPreferredDate(date) {
            this.$emit('change', this.getPreferredDatePicker(date));
        },

        getPreferredDatePicker(date) {
            if (date == null) {
                return '';
            }
            return this.getDateInGlobalFormat(date);
        },

        getPlaceholder() {
            return this.__has(this.schema, 'placeholder') ? this.schema.placeholder : this.trans('Select a date');
        },

    },


}
</script>

<style>
</style>
