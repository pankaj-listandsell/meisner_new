<template>
    <div class="num-inc-field">
        <div class="form-num-manager item1-en">
            <span class="btn-decrement" @click.prevent="decreaseNumber">-</span>
            <span class="input-number-wrap">
                <input type="number"
                        :name="fieldName"
                       :min="0"
                       :id="fieldName"
                       class="form-control"
                       v-model="numberModal"
                       :placeholder="getPlaceholder()"
                       @input="$emit('change', $event.target.value)"
                />
            </span>
            <span class="btn-increment" @click.prevent="increaseNumber">+</span>
            <label class="form-num-label" v-if="showLabel()">{{ schema.label }}</label>
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
            numberModal: '',
        };
    },

    created() {
        this.numberModal = this.defaultValue;
    },

    methods: {

        isRequired() {
            return this.__has(this.schema, 'required') ? !!this.schema.required : false;
        },

        getPlaceholder() {
            return this.__has(this.schema, 'placeholder') ? this.schema.placeholder : '';
        },

        showLabel() {
            return this.__has(this.schema, 'show_label') ? !!this.schema.show_label : true;
        },

        increaseNumber() {
            ++this.numberModal;
            this.$emit('change', this.numberModal);
        },

        decreaseNumber() {
            --this.numberModal;
            if (this.numberModal < 0) {
                this.numberModal = 0;
                return;
            }
            this.$emit('change', this.numberModal);
        }

    },

}
</script>

<style scoped>
</style>
