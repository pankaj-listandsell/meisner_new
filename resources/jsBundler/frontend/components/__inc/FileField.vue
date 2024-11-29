<template>
    <div class="file-field">
        <input type="file"
               :name="fieldName"
               @change="$emit('change', $event.target.files[0])"
        />

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

        };
    },

    async created() {

    },

    methods: {

        isRequired() {
            return this.__has(this.schema, 'required') ? !!this.schema.required : false;
        }

    },


}
</script>

<style scoped>
</style>
