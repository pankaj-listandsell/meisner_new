<template>
    <div class="boolean-checkbox">
        <label>
            <input type="checkbox"
                   :name="fieldName"
                   v-model="checkboxModal"
                   @change="updateValue()"
            />
            <span v-html="getPlaceholder()"></span>
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
    },

    components: {
        ErrorBox

    },

    mixins: [AppHelper],

    data() {
        return {
            checkboxModal: null
        };
    },

    async created() {

    },

    methods: {

        updateValue() {
            this.$emit('change', (!!this.checkboxModal));
        },

        getPlaceholder() {
            return this.__has(this.schema, 'placeholder') ? this.schema.placeholder : '';
        },

    },


}
</script>

<style scoped>
</style>
