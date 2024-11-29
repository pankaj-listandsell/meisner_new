<template>
    <div>
        <template v-if="showForm">
            <section class="booking-form-steps" ref="bookingFormContainer">

            <div class="form-stepper">
                <div class="form-steps">
                    <div class="step" :class="{'step-active' : form.step === 1, 'step-done': form.step > 1}">
                        <span class="step-text">{{ trans('Request a free and inexpensive offer now') }} - {{ trans('Step 1 of 2') }}</span>
                    </div>
                    <div class="step" :class="{'step-active' : form.step === 2, 'step-done': form.step > 2}">
                        <span class="step-text">{{ trans('Your Contact Detail') }} - {{ trans('Step 2 of 2') }}</span>
                    </div>
                </div>

                <div class="progress form-step-progress-bar">
                    <div class="progress-bar" :style="{ width: (getProgressInPercentage()) + '%' }"></div>
                </div>
            </div>

            <transition name="slide-fade">
                <section v-show="form.step === 1">

                    <div class="form-step-first">

                        <div class="form-group">
                            <label for="prefer_date">
                                {{ trans('Do you already have a preferred date?') }}
                                <span class="sym-required">*</span>
                            </label>
                            <SelectField fieldName="has_preferred_date"
                                         :schema="findFormField('has_preferred_date')"
                                         @change="updateField('has_preferred_date', $event)"
                                         :error="getError('has_preferred_date')"
                            ></SelectField>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="preferred_date">
                                        {{ trans('Desired Date') }}
                                        <span class="sym-required">*</span>
                                    </label>
                                    <div class="preferred_date">
                                        <DateField fieldName="preferred_date"
                                                   :config="config"
                                                   :schema="findFormField('preferred_date')"
                                                   @change="updateField('preferred_date', $event)"
                                                   :error="getError('preferred_date')"
                                        ></DateField>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="preferred_time">
                                        {{ trans('Time') }}
                                        <span class="sym-required">*</span>
                                    </label>
                                    <SelectField fieldName="preferred_time"
                                                 :schema="findFormField('preferred_time')"
                                                 @change="updateField('preferred_time', $event)"
                                                 :error="getError('preferred_time')"
                                    ></SelectField>
                                </div>
                            </div>
                        </div>

                        <div class="clearfix step-heading">
                            <strong class="float-left">{{ trans('Painting work by') }}:</strong>
                        </div>

                        <div class="form-group">
                            <label for="preferred_time">
                                {{ trans('What can we do for you?') }}
                                <span class="sym-required">*</span>
                            </label>
                            <MultiSelectImageField fieldName="service"
                                             :schema="findFormField('service')"
                                             @change="updateField('service', $event)"
                                             :error="getError('service')"
                            ></MultiSelectImageField>
                        </div>

                        <div class="form-group-inner">
                            <label>{{ trans('Place of Order') }}: <span class="sym-required">*</span></label>
                            <div class="form-group">
                                <AutocompleteAddress fieldName="order_street"
                                                     :defaultValue="form.order_street"
                                                     :schema="findFormField('order_street')"
                                                     :error="getError('order_street')"
                                                     @selected="updateOrderAddress"
                                                     @change="updateField('order_street', $event)"
                                ></AutocompleteAddress>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <AutocompleteAddress fieldName="order_postal_code"
                                                             :defaultValue="form.order_postal_code"
                                                             :schema="findFormField('order_postal_code')"
                                                             :error="getError('order_postal_code')"
                                                             @selected="updateOrderAddress"
                                                             @change="updateField('order_postal_code', $event)"
                                        ></AutocompleteAddress>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <AutocompleteAddress fieldName="order_city"
                                                             :defaultValue="form.order_city"
                                                             :schema="findFormField('order_city')"
                                                             :error="getError('order_city')"
                                                             @selected="updateOrderAddress"
                                                             @change="updateField('order_city', $event)"
                                        ></AutocompleteAddress>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="order_floor">
                                        {{ trans('Floor') }}
                                        <span class="sym-required">*</span>
                                    </label>
                                    <SelectField fieldName="order_floor"
                                                 :schema="findFormField('order_floor')"
                                                 @change="updateField('order_floor', $event)"
                                                 :error="getError('order_floor')"
                                    ></SelectField>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="order_has_elevator">
                                        {{ trans('Elevator available') }}
                                        <span class="sym-required">*</span>
                                    </label>
                                    <RadioField fieldName="order_has_elevator"
                                                :schema="findFormField('order_has_elevator')"
                                                @change="updateField('order_has_elevator', $event)"
                                                :error="getError('order_has_elevator')"
                                    ></RadioField>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="order_stopping_ban">
                                        {{ trans('Stopping ban necessary') }}
                                        <span class="sym-required">*</span>
                                    </label>
                                    <RadioField fieldName="order_stopping_ban"
                                                :schema="findFormField('order_stopping_ban')"
                                                @change="updateField('order_stopping_ban', $event)"
                                                :error="getError('order_stopping_ban')"
                                    ></RadioField>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-next" @click.prevent="goToNext(getFirstStepFields())">{{ trans('Next') }}</button>

                    </div>

                </section>
            </transition>

            <transition name="slide-fade">
                <section v-show="form.step === 2">

                    <div class="form-step-second">

                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <InputField fieldName="contact_first_name"
                                                    :schema="findFormField('contact_first_name')"
                                                    @change="updateField('contact_first_name', $event)"
                                                    :error="getError('contact_first_name')"
                                                    :default-value="form.contact_first_name"
                                        ></InputField>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <InputField fieldName="contact_last_name"
                                                    :schema="findFormField('contact_last_name')"
                                                    @change="updateField('contact_last_name', $event)"
                                                    :error="getError('contact_last_name')"
                                                    :default-value="form.contact_last_name"
                                        ></InputField>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <InputField fieldName="contact_company"
                                            :schema="findFormField('contact_company')"
                                            @change="updateField('contact_company', $event)"
                                            :error="getError('contact_company')"
                                            :default-value="form.contact_company"
                                ></InputField>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <InputNumberField fieldName="contact_telephone_no"
                                                    :schema="findFormField('contact_telephone_no')"
                                                    @change="updateField('contact_telephone_no', $event)"
                                                    :error="getError('contact_telephone_no')"
                                                    :default-value="form.contact_telephone_no"
                                        ></InputNumberField>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <InputField fieldName="contact_email"
                                                    :schema="findFormField('contact_email')"
                                                    @change="updateField('contact_email', $event)"
                                                    :error="getError('contact_email')"
                                                    :default-value="form.contact_email"
                                        ></InputField>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <TextareaField fieldName="work_note"
                                               :schema="findFormField('work_note')"
                                               @change="updateField('work_note', $event)"
                                               :error="getError('work_note')"
                                               :default-value="form.work_note"
                                ></TextareaField>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="preferred_time">{{ trans('More Services') }}</label>
                            <MultiSelectImageField fieldName="extra_service"
                                             :exclude="form.service"
                                             :schema="findFormField('extra_service')"
                                             @change="updateField('extra_service', $event)"
                                             :error="getError('extra_service')"
                            ></MultiSelectImageField>
                        </div>

                        <div class="form-group">
                            <TermField fieldName="terms"
                                       :schema="findFormField('terms')"
                                       @change="updateField('terms', $event)"
                                       :error="getError('terms')"
                                       :config="config"
                            ></TermField>
                        </div>

                        <div class="step-buttons">
                            <button @click.prevent="prev()"
                                    class="btn btn-primary btn-prev"
                            >
                                {{ trans("Previous") }}
                            </button>
                        </div>

                        <div class="form-submitter">
                            <button class="btn btn-primary"
                                    @click.prevent="registerForm"
                            >{{ trans('Submit') }}</button>
                        </div>

                    </div>

                </section>
            </transition>


        </section>
        </template>
        <template v-else>
            <div id="form_c82398ed87" class="thank-you-message">
                {{ trans('Thank you for contacting us. We will get back in touch with you.') }}
            </div>
        </template>
    </div>
</template>

<script>
import AppHelper from "../../admin/js/mixins/AppHelper";
import AxiosHelper from "../../admin/js/mixins/AxiosHelper";
import NotificationHelper from "../../admin/js/mixins/NotificationHelper";
import SelectField from "./__inc/SelectField.vue";
import DateField from "./__inc/DateField.vue";
import RadioImageField from "./__inc/RadioImageField.vue";
import InputField from "./__inc/InputField.vue";
import RelatedRadioField from "./__inc/RelatedRadioField.vue";
import RadioField from "./__inc/RadioField.vue";
import TextareaField from "./__inc/TextareaField.vue";
import TermField from "./__inc/TermField.vue";
import FileField from "./__inc/FileField.vue";
import MultiSelectImageField from "./__inc/MultiSelectImageField.vue";
import InputNumberField from "./__inc/InputNumberField.vue";
import AutocompleteAddress from "./__googlemap/AutocompleteAddress.vue";

export default {

    props: {
        schema: {
            required: true,
        },
        config: {
            required: true
        },
    },

    components: {
        AutocompleteAddress,
        InputNumberField,
        MultiSelectImageField,
        FileField,
        TermField,
        TextareaField,
        RadioField,
        RelatedRadioField,
        InputField,
        RadioImageField,
        SelectField,
        DateField
    },

    mixins: [AppHelper, AxiosHelper, NotificationHelper],

    data() {
        return {
            loader: null,
            showForm: true,
            form: {
                total_step: 2,
                step: 1,
                lang: this.config.lang,

                has_preferred_date: '',
                preferred_date: '',
                preferred_time: '',
                service: [],

                order_street: '',
                order_postal_code: '',
                order_city: '',
                order_country: '',
                order_floor: '',
                order_has_elevator: '',
                order_stopping_ban: '',

                contact_first_name: '',
                contact_last_name: '',
                contact_company: '',
                contact_telephone_no: '',
                contact_email: '',
                work_note: '',
                extra_service: [],
                terms: '',
            },
            errors: [],
        };
    },

    async created() {
        this.getFormDefaultValues();
    },

    methods: {

        prev() {
            --this.form.step;
        },

        next() {
            ++this.form.step;
        },

        goToNext(form) {
            if (this.isValidInputs(form)) {
                this.next();
            }
        },

        isValidInputs(form) {

            this.errors = [];
            let result = true;

            for (const key of Object.keys(form)) {

                let field = this.findFormField(key);

                if (this.__has(field, 'related')) {
                    if (!this.inArray(this.form[field.related], field.linked)) {
                        continue;
                    }
                }

                let isRequired = this.__has(field, 'required') ? !!field.required : false;

                if (isRequired) {
                    let fieldValue = this.__has(this.form, key) ? this.form[key] : null;

                    if (!fieldValue) {
                        result = false;
                        this.errors.push({
                            name: key,
                            errors: [this.trans('This field is required')],
                        });
                    }
                }
            }

            return result;
        },

        getError(key) {
            return this.errors.find(error => error.name === key) || {};
        },

        getFormDefaultValues() {

            let formKeys = this.getSchemaKeys();

            for (const key of Object.keys(this.form)) {
                if (this.inArray(key, formKeys)) {
                    let form = this.findFormField(key);
                    this.form[key] = form.default;
                }
            }
        },

        getSchemaKeys() {
            return this.schema.map((form) => form.name);
        },

        isBelongsToRelated(key) {
            let field = this.findFormField(key);
            if (this.inArray(this.form[field.related], field.linked)) {
                return true;
            }
            return false;
        },

        findFormField(key) {
            return this.schema.find(form => form.name === key) || {};
        },

        updateField(key, value) {
            if (this.__has(this.form, key)) {
                this.form[key] = value;
            }
        },

        updateOrderAddress(address) {
            this.form.order_street = address.street;
            this.form.order_postal_code = address.postal_code;
            this.form.order_city = address.city;
            this.form.order_country = address.country;
        },

        loadingOn() {
            this.loader = this.$loading.show({container: this.$refs.bookingFormContainer});
        },

        loadingOff() {
            this.loader.hide();
        },

        getProgressInPercentage() {
            return (this.form.step / this.form.total_step) * 100;
        },

        registerForm() {

            if (!this.isValidInputs(this.getSecondStepFields())) {
                return;
            }

            this.loadingOn();

            this.postServerCall(this.config.registerFormUrl, this.getFormData(this.form, this.getHoneyPotData(this.config)), {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
                .then((response) => {

                    this.loadingOff();

                    if (response.status == 200) {
                        this.scrollToTop();
                        this.showForm = false;
                    }

                    if (response.status == 422) {
                        this.alertToast(response.data.errors, '', 'error', 1);
                    }

                });
        },

        getFirstStepFields() {
            return {
                has_preferred_date: '',
                preferred_date: '',
                preferred_time: '',
                service: [],

                order_street: '',
                order_postal_code: '',
                order_city: '',
                order_country: '',
                order_floor: '',
                order_has_elevator: '',
                order_stopping_ban: '',
            };
        },

        getSecondStepFields() {
            return {
                contact_first_name: '',
                contact_last_name: '',
                contact_company: '',
                contact_telephone_no: '',
                contact_email: '',
                work_note: '',
                extra_service: [],
                terms: '',
            };
        },


        asset(path) {
            return this.config.getAssetUrl + path;
        },

    },


}
</script>

<style>
</style>
