<template>
    <div class="input-field">
        <input  type="number"
                :name="fieldName"
                :id="fieldName"
                class="form-control"
                :value="defaultValue"
                :required="isRequired()"
                @input="$emit('change', $event.target.value)"
                :disabled="disabledStatus"
        />
        <label :for="fieldName">{{ getPlaceholder()}}</label>
        <ErrorBox :error="error"></ErrorBox>
    </div>
</template>

<script>
import AppHelper from "../../../admin/js/mixins/AppHelper";
import ErrorBox from "./ErrorBox.vue";

export default {

    props: {
        defaultValue: {
            default: '',
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
        disabled: {
            default: false,
        }
    },

    components: {
        ErrorBox
    },

    mixins: [AppHelper],

    data() {
        return {
            disabledStatus: false,
        };
    },

    created() {
        this.disabledStatus = Boolean(this.disabled)
    },

    updated() {
        this.disabledStatus = Boolean(this.disabled);
    },

    methods: {

        getPlaceholder() {
            return this.__has(this.schema, 'placeholder') ? this.schema.placeholder : '';
        },

        isRequired() {
            return this.__has(this.schema, 'required') ? !!this.schema.required : false;
        }

    },

}
</script>

<style scoped>
</style>
