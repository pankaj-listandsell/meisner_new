<template>
    <div class="select-field">
        <select :name="fieldName"
                :id="fieldName"
                class="form-control"
                :required="isRequired()"
                @change="onChange($event.target.value)"
        >
            <template v-if="hasPlaceholder()">
                <option value="">
                    {{ getPlaceholder() }}
                </option>
            </template>
            <option v-for="option in getFormOptions()"
                    :value="option"
            >{{ option }}</option>
        </select>

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

        hasPlaceholder() {
            return this.__has(this.schema, 'placeholder') ? !!this.schema.placeholder : false;
        },

        getPlaceholder() {
            return this.__has(this.schema, 'placeholder') ? this.schema.placeholder : '';
        },

        getFormOptions() {
            return this.__has(this.schema, 'options') ? this.schema.options : [];
        },

        isRequired() {
            return this.__has(this.schema, 'required') ? !!this.schema.required : false;
        },

        onChange(value) {
            this.$emit('change', value);
            this.$emit('updated', value);
        }

    },

}
</script>

<style scoped>
</style>
