<template>
    <div class="textarea-field">
        <textarea :name="fieldName"
                :id="fieldName"
                class="form-control"
                :required="isRequired()"
                :placeholder="getPlaceholder()"
                @input="$emit('change', $event.target.value)"
        >{{ defaultValue }}</textarea>
        <ErrorBox :error="error"></ErrorBox>
    </div>
</template>

<script>
import AppHelper from "../../../admin/js/mixins/AppHelper";
import ErrorBox from "./ErrorBox.vue";

export default {

    props: {
        schema: {
            required: true,
        },
        fieldName: {
            required: true
        },
        defaultValue: {
            default: ''
        },
        error: {
            type: Object,
            require: true,
        }
    },

    components: {
        ErrorBox

    },

    mixins: [AppHelper],

    data() {
        return {

        };
    },

    async created() {

    },

    methods: {

        getPlaceholder() {
            return this.__has(this.schema, 'placeholder') ? this.schema.placeholder : '';
        },

        getFormOptions() {
            return this.__has(this.schema, 'options') ? this.schema.options : [];
        },

        isRequired() {
            return this.__has(this.schema, 'required') ? !!this.schema.required : false;
        }

    },

}
</script>

<style scoped>
</style>
