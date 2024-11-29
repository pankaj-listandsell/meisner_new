<template>
    <div class="term-section">
        <label>
            <input type="checkbox"
                   :name="fieldName"
                   v-model="termModal"
                   @change="updateTerm()"
            />
            <span v-html="config.getTermText"></span>
        </label>

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
        },
        config: {
            required: true,
        }
    },

    components: {
        ErrorBox

    },

    mixins: [AppHelper],

    data() {
        return {
            termModal: null
        };
    },

    async created() {

    },

    methods: {

        isRequired() {
            return this.__has(this.schema, 'required') ? !!this.schema.required : false;
        },

        updateTerm() {
            this.$emit('change', (this.termModal ? this.trans('Yes') : ''));
        }

    },


}
</script>

<style scoped>
</style>
