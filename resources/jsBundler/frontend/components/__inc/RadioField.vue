<template>
    <div class="radio-section">
        <div class="radio-form">
            <label v-for="option in getFormOptions()">
                <input type="radio"
                       :name="fieldName"
                       :value="option"
                       @change="$emit('change', $event.target.value)"
                       :checked="option == defaultValue"
                />
                <span class="radio-l-name">{{ option }}</span>
            </label>
        </div>

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
            default: '',
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
