<template>
    <div class="radio-image-section">
        <div class="radio-image">
            <label v-for="option in getFormOptions()" class="radio-image-item">
                <figure class="rii-image"><img :src="option.image" :alt="option.name"/></figure>
                <span class="rii-name">{{ option.name }}</span>
                <input type="checkbox" :name="fieldName" :value="option.name" v-model="selectedOptions" @change="changeRadioSelection()"/>
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
        error: {
            type: Object,
            require: true,
        },
        exclude: {
            type: Array,
            default: () => []
        },
    },

    components: {
        ErrorBox
    },

    mixins: [AppHelper],

    data() {
        return {
            selectedOptions: [],
        };
    },

    async created() {

    },

    methods: {

        getFormOptions() {
            let options = this.__has(this.schema, 'options') ? this.schema.options : [];
            return options.filter((option) => {
                return !this.exclude.includes(option.name);
            }).map((option) => {
                option.selected = false;
                return option;
            });
        },

        isRequired() {
            return this.__has(this.schema, 'required') ? !!this.schema.required : false;
        },

        changeRadioSelection() {
            this.$emit('change', this.selectedOptions)
        }

    },


}
</script>

<style scoped>
</style>
