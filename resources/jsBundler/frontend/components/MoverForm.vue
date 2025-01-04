<template>
    <div>

        <template v-if="showForm">

            <section class="booking-form-steps" ref="bookingFormContainer">

                <div class="form-stepper">
                    <div class="gradual-form-steps">
                        <div class="step" :class="{'step-active' : form.step === 1, 'step-done': form.step > 1}">
                            <span class="step-text text-uppercase">{{ trans('Address') }}</span>
                        </div>
                        <div class="step" :class="{'step-active' : form.step === 2, 'step-done': form.step > 2}">
                            <span class="step-text text-uppercase">{{ trans('Relocation data') }}</span>
                        </div>
                        <div class="step" :class="{'step-active' : form.step === 3, 'step-done': form.step > 2}">
                            <span class="step-text text-uppercase">{{ trans('Moving Details') }}</span>
                        </div>
                        <div class="step" :class="{'step-active' : form.step === 4, 'step-done': form.step > 4}">
                            <span class="step-text text-uppercase">{{ trans('Furniture and packing list') }}</span>
                        </div>
                    </div>
                </div>

                <transition name="slide-fade">
                    <section v-show="form.step === 1">

                        <h5>{{ trans('Request now a free quote for your move') }}</h5>

                        <div class="form-address">

                            <div class="row">
                                <div class="col-md-6" :key="generateRandomId()">

                                    <div class="from-location">

                                        <h5>{{ trans('From') }}:</h5>

                                        <div class="from-type form-group">
                                            <RadioField fieldName="mover_type"
                                                        :defaultValue="form.mover_type"
                                                        :schema="findFormField('mover_type')"
                                                        @change="updateField('mover_type', $event)"
                                                        :error="getError('mover_type')"
                                            ></RadioField>
                                        </div>

                                        <div class="from-address">
                                            <div class="form-group from-street">
                                                <label>
                                                    {{ trans('Street & house number') }}
                                                    <span class="sym-required">*</span>
                                                </label>
                                                <AutocompleteAddress fieldName="from_street"
                                                                     :defaultValue="form.from_street"
                                                                     :schema="findFormField('from_street')"
                                                                     :error="getError('from_street')"
                                                                     @selected="updateFromAddress"
                                                                     @change="updateField('from_street', $event)"
                                                ></AutocompleteAddress>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group from-zip-code">
                                                        <label class="text-uppercase">
                                                            {{ trans('Plz') }}
                                                            <span class="sym-required">*</span>
                                                        </label>
                                                        <AutocompleteAddress fieldName="from_postal_code"
                                                                             :defaultValue="form.from_postal_code"
                                                                             :schema="findFormField('from_postal_code')"
                                                                             :error="getError('from_postal_code')"
                                                                             @selected="updateFromAddress"
                                                                             @change="updateField('from_postal_code', $event)"
                                                        ></AutocompleteAddress>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group from-city">
                                                        <label>
                                                            {{ trans('Location') }}
                                                            <span class="sym-required">*</span>
                                                        </label>
                                                        <AutocompleteAddress fieldName="from_city"
                                                                             :defaultValue="form.from_city"
                                                                             :schema="findFormField('from_city')"
                                                                             :error="getError('from_city')"
                                                                             @selected="updateFromAddress"
                                                                             @change="updateField('from_city', $event)"
                                                        ></AutocompleteAddress>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="via-location">

                                        <h5>{{ trans('Via') }}:
                                            <button class="btn btn-primary btn-sm"
                                                    @click="toggleViaAddress"
                                            >{{ form.has_via_address ? '-' : '+' }}</button>
                                        </h5>

                                        <div class="via-address" v-if="form.has_via_address">
                                            <div class="form-group via-street">
                                                <label>{{ trans('Street & house number') }}</label>
                                                <AutocompleteAddress fieldName="via_street"
                                                                     :defaultValue="form.via_street"
                                                                     :schema="findFormField('via_street')"
                                                                     :error="getError('via_street')"
                                                                     @selected="updateViaAddress"
                                                                     @change="updateField('via_street', $event)"
                                                ></AutocompleteAddress>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group via-zip-code">
                                                        <label>{{ trans('Plz') }}</label>
                                                        <AutocompleteAddress fieldName="via_postal_code"
                                                                             :defaultValue="form.via_postal_code"
                                                                             :schema="findFormField('via_postal_code')"
                                                                             :error="getError('via_postal_code')"
                                                                             @selected="updateViaAddress"
                                                                             @change="updateField('via_postal_code', $event)"
                                                        ></AutocompleteAddress>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group via-city">
                                                        <label>{{ trans('Location') }}</label>
                                                        <AutocompleteAddress fieldName="via_city"
                                                                             :defaultValue="form.via_city"
                                                                             :schema="findFormField('via_city')"
                                                                             :error="getError('via_city')"
                                                                             @selected="updateViaAddress"
                                                                             @change="updateField('via_city', $event)"
                                                        ></AutocompleteAddress>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="to-location">

                                        <h5>{{ trans('To') }}:</h5>

                                        <div class="from-type form-group">
                                            <BooleanCheckboxField field-name="has_not_to_address"
                                                                  :defaultValue="form.has_not_to_address"
                                                                  :schema="findFormField('has_not_to_address')"
                                                                  :error="getError('has_not_to_address')"
                                                                  @change="updateHasNotToAddress('has_not_to_address', $event)"
                                            ></BooleanCheckboxField>
                                        </div>

                                        <div class="to-address">
                                            <div class="form-group to-street">
                                                <label>
                                                    {{ trans('Street & house number') }}
                                                    <span class="sym-required">*</span>
                                                </label>
                                                <AutocompleteAddress fieldName="to_street"
                                                                     :defaultValue="form.to_street"
                                                                     :schema="findFormField('to_street')"
                                                                     :error="getError('to_street')"
                                                                     :disabled="form.has_not_to_address"
                                                                     @selected="updateToAddress"
                                                                     @change="updateField('to_street', $event)"
                                                ></AutocompleteAddress>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group to-zip-code">
                                                        <label>
                                                            {{ trans('Plz') }}
                                                            <span class="sym-required">*</span>
                                                        </label>
                                                        <AutocompleteAddress fieldName="to_postal_code"
                                                                             :defaultValue="form.to_postal_code"
                                                                             :schema="findFormField('to_postal_code')"
                                                                             :error="getError('to_postal_code')"
                                                                             :disabled="form.has_not_to_address"
                                                                             @selected="updateToAddress"
                                                                             @change="updateField('to_postal_code', $event)"
                                                        ></AutocompleteAddress>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group to-city">
                                                        <label>
                                                            {{ trans('Location') }}
                                                            <span class="sym-required">*</span>
                                                        </label>
                                                        <AutocompleteAddress fieldName="to_city"
                                                                             :defaultValue="form.to_city"
                                                                             :schema="findFormField('to_city')"
                                                                             :error="getError('to_city')"
                                                                             :disabled="form.has_not_to_address"
                                                                             @selected="updateToAddress"
                                                                             @change="updateField('to_city', $event)"
                                                        ></AutocompleteAddress>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <button class="btn btn-primary btn-next" @click.prevent="goToNext(getFirstStepFields())">
                                        {{ trans('Continue') }}
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <div id="google-map"></div>
                                    <div class="summary-panel">
                                        <div v-html="summaryPanel"></div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </section>
                </transition>

                <transition name="slide-fade">
                    <section v-show="form.step === 2">

                        <div class="form-relocation-data">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box-section">
                                        <h4>{{ trans('From') }} {{ form.from_city }}</h4>
                                        <div class="dest-location-name">
                                            <span class="dest-address-street">{{ form.from_street }}</span>
                                            <span class="dest-address-postal-code">{{ form.from_postal_code }}</span>
                                            <span class="dest-address-city">{{ form.from_city }},</span>
                                            <span class="dest-address-country">{{ form.from_country }}</span>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('I live in a') }}</label>
                                                    <SelectField field-name="from_lives_in"
                                                                 :schema="findFormField('from_lives_in')"
                                                                 @change="updateField('from_lives_in', $event)"
                                                                 :error="getError('from_lives_in')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('Persons') }}</label>
                                                    <SelectField field-name="from_total_persons"
                                                                 :schema="findFormField('from_total_persons')"
                                                                 @change="updateField('from_total_persons', $event)"
                                                                 :error="getError('from_total_persons')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="const-label">{{ trans('Floors') }}</label>
                                                    <SelectField field-name="from_floor"
                                                                 :schema="findFormField('from_floor')"
                                                                 @change="updateField('from_floor', $event)"
                                                                 :error="getError('from_floor')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="const-label"></label>
                                                    <BooleanCheckboxField field-name="from_has_elevator"
                                                                          :defaultValue="form.from_has_elevator"
                                                                          :schema="findFormField('from_has_elevator')"
                                                                          :error="getError('from_has_elevator')"
                                                                          @change="updateField('from_has_elevator', $event)"
                                                    ></BooleanCheckboxField>
                                                </div>
                                            </div>
                                        </div>
                                        <template v-if="form.from_has_elevator">
                                            <div class="form-group">
                                                <label class="const-label">{{ trans('Fit all items in the elevator') }}</label>
                                                <SelectField field-name="from_fit_items_in_elevator"
                                                             :schema="findFormField('from_fit_items_in_elevator')"
                                                             @change="updateField('from_fit_items_in_elevator', $event)"
                                                             :error="getError('from_fit_items_in_elevator')"
                                                ></SelectField>
                                            </div>
                                            <label>{{ trans('Size of the elevator in KG /number of persons') }}</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <InputField field-name="from_elevator_size"
                                                                    :schema="findFormField('from_elevator_size')"
                                                                    @change="updateField('from_elevator_size', $event)"
                                                                    :error="getError('from_elevator_size')"
                                                        ></InputField>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <SelectField field-name="from_elevator_size_unit"
                                                                     :schema="findFormField('from_elevator_size_unit')"
                                                                     @change="updateField('from_elevator_size_unit', $event)"
                                                                     :error="getError('from_elevator_size_unit')"
                                                        ></SelectField>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="const-label">{{ trans('Rooms') }}</label>
                                                    <SelectField field-name="from_total_rooms"
                                                                 :schema="findFormField('from_total_rooms')"
                                                                 @change="updateField('from_total_rooms', $event)"
                                                                 :error="getError('from_total_rooms')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="const-label">{{ trans('No stopping') }}</label>
                                                    <SelectField field-name="from_no_stopping"
                                                                 :schema="findFormField('from_no_stopping')"
                                                                 @change="updateField('from_no_stopping', $event)"
                                                                 :error="getError('from_no_stopping')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="const-label"></label>
                                                    <BooleanCheckboxField field-name="from_furniture_disassemble"
                                                                          :defaultValue="form.from_furniture_disassemble"
                                                                          :schema="findFormField('from_furniture_disassemble')"
                                                                          :error="getError('from_furniture_disassemble')"
                                                                          @change="updateField('from_furniture_disassemble', $event)"
                                                    ></BooleanCheckboxField>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="const-label">
                                                        {{ trans('Living space') }}
                                                        <span class="sym-required">*</span>
                                                    </label>
                                                    <InputNumberField field-name="from_living_space"
                                                                :defaultValue="form.from_living_space"
                                                                :schema="findFormField('from_living_space')"
                                                                :error="getError('from_living_space')"
                                                                @change="updateField('from_living_space', $event)"
                                                    ></InputNumberField>
                                                </div>
                                            </div>
                                        </div>
                                        <template v-if="form.from_furniture_disassemble">
                                            <div class="form-group">
                                                <label class="const-label">{{ trans('What needs to be disassembled?') }}</label>
                                                <TextareaField field-name="from_furniture_disassemble_detail"
                                                               :defaultValue="form.from_furniture_disassemble_detail"
                                                               :schema="findFormField('from_furniture_disassemble_detail')"
                                                               :error="getError('from_furniture_disassemble_detail')"
                                                               @change="updateField('from_furniture_disassemble_detail', $event)"
                                                ></TextareaField>
                                            </div>
                                        </template>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <BooleanCheckboxField field-name="from_kitchen_disassemble"
                                                                      :defaultValue="form.from_kitchen_disassemble"
                                                                      :schema="findFormField('from_kitchen_disassemble')"
                                                                      :error="getError('from_kitchen_disassemble')"
                                                                      @change="updateField('from_kitchen_disassemble', $event)"
                                                ></BooleanCheckboxField>
                                            </div>
                                            <div class="col-md-6">
                                                <BooleanCheckboxField field-name="from_packing_cartons"
                                                                      :defaultValue="form.from_packing_cartons"
                                                                      :schema="findFormField('from_packing_cartons')"
                                                                      :error="getError('from_packing_cartons')"
                                                                      @change="updateField('from_packing_cartons', $event)"
                                                ></BooleanCheckboxField>
                                            </div>
                                        </div>
                                        <template v-if="form.from_kitchen_disassemble">
                                            <div class="form-group">
                                                <label class="const-label">{{ trans('What needs to be disassembled?') }}</label>
                                                <TextareaField field-name="from_kitchen_disassemble_detail"
                                                               :defaultValue="form.from_kitchen_disassemble_detail"
                                                               :schema="findFormField('from_kitchen_disassemble_detail')"
                                                               :error="getError('from_kitchen_disassemble_detail')"
                                                               @change="updateField('from_kitchen_disassemble_detail', $event)"
                                                ></TextareaField>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box-section">
                                        <h4>{{ trans('To') }} {{ form.to_city }}</h4>
                                        <div class="dest-location-name">
                                            <span class="dest-address-street">{{ form.to_street }}</span>
                                            <span class="dest-address-postal-code">{{ form.to_postal_code }}</span>
                                            <span class="dest-address-city">{{ form.to_city }},</span>
                                            <span class="dest-address-country">{{ form.to_country }}</span>
                                        </div>
                                        <div class="form-group">
                                            <label class="label-const">{{ trans('I move to a') }}</label>
                                            <SelectField field-name="to_move_to"
                                                         :schema="findFormField('to_move_to')"
                                                         @change="updateField('to_move_to', $event)"
                                                         :error="getError('to_move_to')"
                                            ></SelectField>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-const">{{ trans('Floors') }}</label>
                                                    <SelectField field-name="to_floor"
                                                                 :schema="findFormField('to_floor')"
                                                                 @change="updateField('to_floor', $event)"
                                                                 :error="getError('to_floor')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="label-const"></label>
                                                <BooleanCheckboxField field-name="to_has_elevator"
                                                                      :schema="findFormField('to_has_elevator')"
                                                                      @change="updateField('to_has_elevator', $event)"
                                                                      :error="getError('to_has_elevator')"
                                                ></BooleanCheckboxField>
                                            </div>
                                        </div>
                                        <template v-if="form.to_has_elevator">
                                            <div class="form-group">
                                                <label class="const-label">{{ trans('Fit all items in the elevator') }}</label>
                                                <SelectField field-name="to_fit_items_in_elevator"
                                                             :schema="findFormField('to_fit_items_in_elevator')"
                                                             @change="updateField('to_fit_items_in_elevator', $event)"
                                                             :error="getError('to_fit_items_in_elevator')"
                                                ></SelectField>
                                            </div>
                                            <label>{{ trans('Size of the elevator in KG /number of persons') }}</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <InputField field-name="to_elevator_size"
                                                                    :schema="findFormField('to_elevator_size')"
                                                                    @change="updateField('to_elevator_size', $event)"
                                                                    :error="getError('to_elevator_size')"
                                                        ></InputField>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <SelectField field-name="to_elevator_size_unit"
                                                                     :schema="findFormField('to_elevator_size_unit')"
                                                                     @change="updateField('to_elevator_size_unit', $event)"
                                                                     :error="getError('to_elevator_size_unit')"
                                                        ></SelectField>
                                                    </div>
                                                </div>
                                            </div>
                                        </template>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="const-label">{{ trans('No stopping') }}</label>
                                                    <SelectField field-name="to_no_stopping"
                                                                 :schema="findFormField('to_no_stopping')"
                                                                 @change="updateField('to_no_stopping', $event)"
                                                                 :error="getError('to_no_stopping')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="const-label"></label>
                                                    <BooleanCheckboxField field-name="to_furniture_assemble"
                                                                          :schema="findFormField('to_furniture_assemble')"
                                                                          @change="updateField('to_furniture_assemble', $event)"
                                                                          :error="getError('to_furniture_assemble')"
                                                    ></BooleanCheckboxField>
                                                </div>
                                            </div>
                                        </div>
                                        <template v-if="form.to_furniture_assemble">
                                            <div class="form-group">
                                                <label class="const-label">{{ trans('Assemble list of furniture') }}</label>
                                                <TextareaField field-name="to_furniture_assemble_detail"
                                                               :schema="findFormField('to_furniture_assemble_detail')"
                                                               @change="updateField('to_furniture_assemble_detail', $event)"
                                                               :error="getError('to_furniture_assemble_detail')"
                                                ></TextareaField>
                                            </div>
                                        </template>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <BooleanCheckboxField field-name="to_unpack_boxes"
                                                                        :schema="findFormField('to_unpack_boxes')"
                                                                        @change="updateField('to_unpack_boxes', $event)"
                                                                        :error="getError('to_unpack_boxes')"
                                                    ></BooleanCheckboxField>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <BooleanCheckboxField field-name="assemble_kitchen"
                                                                        :schema="findFormField('assemble_kitchen')"
                                                                        @change="updateField('assemble_kitchen', $event)"
                                                                        :error="getError('assemble_kitchen')"
                                                    ></BooleanCheckboxField>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box-section">
                                <h5 class="text-uppercase">{{ trans('When do you want to move?') }}</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ trans('Moving date') }}</label>
                                            <SelectField field-name="moving_date"
                                                         :schema="findFormField('moving_date')"
                                                         @change="updateField('moving_date', $event)"
                                                         @updated="changeOnMovingDate()"
                                                         :error="getError('moving_date')"
                                            ></SelectField>
                                        </div>
                                    </div>
                                    <template v-if="form.moving_date == trans('Flexible period')">
                                        <div class="col-md-8" :key="generateRandomId()">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ trans('From') }} <span class="sym-required">*</span></label>
                                                        <DateField fieldName="moving_date_from"
                                                                   :config="config"
                                                                   :default-value="''"
                                                                   :schema="findFormField('moving_date_from')"
                                                                   @change="updateField('moving_date_from', $event)"
                                                                   :error="getError('moving_date_from')"
                                                        ></DateField>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ trans('To') }} <span class="sym-required">*</span></label>
                                                        <DateField fieldName="moving_date_to"
                                                                   :config="config"
                                                                   :default-value="''"
                                                                   :schema="findFormField('moving_date_to')"
                                                                   @change="updateField('moving_date_to', $event)"
                                                                   :error="getError('moving_date_to')"
                                                        ></DateField>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <template v-if="form.moving_date == trans('Fixed rate')">
                                        <div class="col-md-4" :key="generateRandomId()">
                                            <div class="form-group">
                                                <label>{{ trans('Moving Date') }} <span class="sym-required">*</span></label>
                                                <DateField fieldName="moving_date_from"
                                                           :config="config"
                                                           :default-value="''"
                                                           :schema="findFormField('moving_date_from')"
                                                           @change="updateField('moving_date_from', $event)"
                                                           :error="getError('moving_date_from')"
                                                ></DateField>
                                            </div>
                                        </div>
                                    </template>

                                    <template v-if="form.moving_date == trans('Removal with storage')">
                                        <div class="col-md-8" :key="generateRandomId()">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ trans('Move out') }} <span class="sym-required">*</span></label>
                                                        <DateField fieldName="moving_date_from"
                                                                   :config="config"
                                                                   :default-value="''"
                                                                   :schema="findFormField('moving_date_from')"
                                                                   @change="updateField('moving_date_from', $event)"
                                                                   :error="getError('moving_date_from')"
                                                        ></DateField>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{ trans('Move in') }} <span class="sym-required">*</span></label>
                                                        <DateField fieldName="moving_date_to"
                                                                   :config="config"
                                                                   :default-value="''"
                                                                   :schema="findFormField('moving_date_to')"
                                                                   @change="updateField('moving_date_to', $event)"
                                                                   :error="getError('moving_date_to')"
                                                        ></DateField>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>

                                </div>
                            </div>

                            <div class="box-section">
                                <h5 class="text-uppercase">{{ trans('How do we reach them?') }}</h5>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ trans('Title') }}</label>
                                            <SelectField field-name="reach_title"
                                                         :schema="findFormField('reach_title')"
                                                         @change="updateField('reach_title', $event)"
                                                         :error="getError('reach_title')"
                                            ></SelectField>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ trans('Name') }} <span class="sym-required">*</span></label>
                                            <InputField field-name="reach_name"
                                                        :default-value="form.reach_name"
                                                        :schema="findFormField('reach_name')"
                                                        @change="updateField('reach_name', $event)"
                                                        :error="getError('reach_name')"
                                            ></InputField>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ trans('Telephone') }} <span class="sym-required">*</span></label>
                                            <InputField field-name="reach_telephone"
                                                        :default-value="form.reach_telephone"
                                                        :schema="findFormField('reach_telephone')"
                                                        @change="updateField('reach_telephone', $event)"
                                                        :error="getError('reach_telephone')"
                                            ></InputField>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ trans('E-mail') }} <span class="sym-required">*</span></label>
                                            <InputField field-name="reach_email"
                                                        :default-value="form.reach_email"
                                                        :schema="findFormField('reach_email')"
                                                        @change="updateField('reach_email', $event)"
                                                        :error="getError('reach_email')"
                                            ></InputField>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>{{ trans('Who will pay the costs?') }}</label>
                                            <SelectField field-name="reach_cost"
                                                         :schema="findFormField('reach_cost')"
                                                         @change="updateField('reach_cost', $event)"
                                                         :error="getError('reach_cost')"
                                            ></SelectField>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="step-buttons clearfix">
                                <button @click.prevent="prev()"
                                        class="btn btn-primary btn-prev float-left"
                                >
                                    {{ trans("Previous") }}
                                </button>
                                <button class="btn btn-primary btn-next float-right"
                                        @click.prevent="goToNext(getSecondStepFields())"
                                >{{ trans('Continue') }}
                                </button>
                            </div>

                        </div>

                    </section>
                </transition>

                <transition name="slide-fade">
                    <section v-show="form.step === 3">

                        <div class="form-moving-detail">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="box-section">
                                        <h4>{{ trans('From') }} {{ form.from_city }}</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('Carrying distance') }}</label>
                                                    <SelectField field-name="from_carrying_distance"
                                                                 :schema="findFormField('from_carrying_distance')"
                                                                 @change="updateField('from_carrying_distance', $event)"
                                                                 :error="getError('from_carrying_distance')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('Staircase') }}</label>
                                                    <SelectField field-name="from_staircase"
                                                                 :schema="findFormField('from_staircase')"
                                                                 @change="updateField('from_staircase', $event)"
                                                                 :error="getError('from_staircase')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="const-label">{{ trans('House position') }}</label>
                                                    <SelectField field-name="from_house_position"
                                                                 :schema="findFormField('from_house_position')"
                                                                 @change="updateField('from_house_position', $event)"
                                                                 :error="getError('from_house_position')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="const-label">{{ trans('Notes on loading') }}</label>
                                            <TextareaField field-name="from_loading_note"
                                                           :defaultValue="form.from_loading_note"
                                                           :schema="findFormField('from_loading_note')"
                                                           :error="getError('from_loading_note')"
                                                           @change="updateField('from_loading_note', $event)"
                                            ></TextareaField>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="box-section">
                                        <h4>{{ trans('To') }} {{ form.to_city }}</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('Carrying distance') }}</label>
                                                    <SelectField field-name="to_carrying_distance"
                                                                 :schema="findFormField('to_carrying_distance')"
                                                                 @change="updateField('to_carrying_distance', $event)"
                                                                 :error="getError('to_carrying_distance')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ trans('Staircase') }}</label>
                                                    <SelectField field-name="to_staircase"
                                                                 :schema="findFormField('to_staircase')"
                                                                 @change="updateField('to_staircase', $event)"
                                                                 :error="getError('to_staircase')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="const-label">{{ trans('House position') }}</label>
                                                    <SelectField field-name="to_house_position"
                                                                 :schema="findFormField('to_house_position')"
                                                                 @change="updateField('to_house_position', $event)"
                                                                 :error="getError('to_house_position')"
                                                    ></SelectField>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="const-label">{{ trans('Notes on loading') }}</label>
                                            <TextareaField field-name="to_loading_note"
                                                           :defaultValue="form.to_loading_note"
                                                           :schema="findFormField('to_loading_note')"
                                                           :error="getError('to_loading_note')"
                                                           @change="updateField('to_loading_note', $event)"
                                            ></TextareaField>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="step-buttons clearfix">
                                <button @click.prevent="prev()"
                                        class="btn btn-primary btn-prev float-left"
                                >
                                    {{ trans("Previous") }}
                                </button>
                                <button class="btn btn-primary btn-next float-right"
                                        @click.prevent="goToNext(getThirdStepFields())"
                                >{{ trans('Continue') }}
                                </button>
                            </div>

                        </div>

                    </section>
                </transition>

                <transition name="slide-fade">
                    <section v-show="form.step === 4">

                        <div class="form-packing-list">

                            <div class="row">
                                <div class="col-md-9">
                                    <v-collapse-group :onlyOneActive="true">
                                        <v-collapse-wrapper ref="firstAccordion">
                                            <div class="form-tab-header" v-collapse-toggle>
                                                <h3 class="tab-label">
                                                    <img class="tab-img" src="/uploads/0000/1/2024/02/27/wohn.png"/>
                                                    {{ trans('Living room') }}
                                                </h3>
                                            </div>
                                            <div class="form-tab-content" v-collapse-content>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="living_room_wall_unit"
                                                                        :defaultValue="form.living_room_wall_unit"
                                                                        :schema="findFormField('living_room_wall_unit')"
                                                                        :error="getError('living_room_wall_unit')"
                                                                        @change="updateField('living_room_wall_unit', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_buffet"
                                                                        :defaultValue="form.living_room_buffet"
                                                                        :schema="findFormField('living_room_buffet')"
                                                                        :error="getError('living_room_buffet')"
                                                                        @change="updateField('living_room_buffet', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_tv_others"
                                                                        :defaultValue="form.living_room_tv_others"
                                                                        :schema="findFormField('living_room_tv_others')"
                                                                        :error="getError('living_room_tv_others')"
                                                                        @change="updateField('living_room_tv_others', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_wing"
                                                                        :defaultValue="form.living_room_wing"
                                                                        :schema="findFormField('living_room_wing')"
                                                                        :error="getError('living_room_wing')"
                                                                        @change="updateField('living_room_wing', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_solid_desk"
                                                                        :defaultValue="form.living_room_solid_desk"
                                                                        :schema="findFormField('living_room_solid_desk')"
                                                                        :error="getError('living_room_solid_desk')"
                                                                        @change="updateField('living_room_solid_desk', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_sideboard_display_case"
                                                                        :defaultValue="form.living_room_sideboard_display_case"
                                                                        :schema="findFormField('living_room_sideboard_display_case')"
                                                                        :error="getError('living_room_sideboard_display_case')"
                                                                        @change="updateField('living_room_sideboard_display_case', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_sofa_couch"
                                                                        :defaultValue="form.living_room_sofa_couch"
                                                                        :schema="findFormField('living_room_sofa_couch')"
                                                                        :error="getError('living_room_sofa_couch')"
                                                                        @change="updateField('living_room_sofa_couch', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_chair"
                                                                        :defaultValue="form.living_room_chair"
                                                                        :schema="findFormField('living_room_chair')"
                                                                        :error="getError('living_room_chair')"
                                                                        @change="updateField('living_room_chair', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_video_console"
                                                                        :defaultValue="form.living_room_video_console"
                                                                        :schema="findFormField('living_room_video_console')"
                                                                        :error="getError('living_room_video_console')"
                                                                        @change="updateField('living_room_video_console', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_e_piano"
                                                                        :defaultValue="form.living_room_e_piano"
                                                                        :schema="findFormField('living_room_e_piano')"
                                                                        :error="getError('living_room_e_piano')"
                                                                        @change="updateField('living_room_e_piano', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="living_room_bookshelf"
                                                                        :defaultValue="form.living_room_bookshelf"
                                                                        :schema="findFormField('living_room_bookshelf')"
                                                                        :error="getError('living_room_bookshelf')"
                                                                        @change="updateField('living_room_bookshelf', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_buffet_without_attachment"
                                                                        :defaultValue="form.living_room_buffet_without_attachment"
                                                                        :schema="findFormField('living_room_buffet_without_attachment')"
                                                                        :error="getError('living_room_buffet_without_attachment')"
                                                                        @change="updateField('living_room_buffet_without_attachment', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_living_tv_table"
                                                                        :defaultValue="form.living_room_living_tv_table"
                                                                        :schema="findFormField('living_room_living_tv_table')"
                                                                        :error="getError('living_room_living_tv_table')"
                                                                        @change="updateField('living_room_living_tv_table', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_piano"
                                                                        :defaultValue="form.living_room_piano"
                                                                        :schema="findFormField('living_room_piano')"
                                                                        :error="getError('living_room_piano')"
                                                                        @change="updateField('living_room_piano', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_desk_not_solid"
                                                                        :defaultValue="form.living_room_desk_not_solid"
                                                                        :schema="findFormField('living_room_desk_not_solid')"
                                                                        :error="getError('living_room_desk_not_solid')"
                                                                        @change="updateField('living_room_desk_not_solid', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_arm_chair"
                                                                        :defaultValue="form.living_room_arm_chair"
                                                                        :schema="findFormField('living_room_arm_chair')"
                                                                        :error="getError('living_room_arm_chair')"
                                                                        @change="updateField('living_room_arm_chair', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_old_clock"
                                                                        :defaultValue="form.living_room_old_clock"
                                                                        :schema="findFormField('living_room_old_clock')"
                                                                        :error="getError('living_room_old_clock')"
                                                                        @change="updateField('living_room_old_clock', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_table"
                                                                        :defaultValue="form.living_room_table"
                                                                        :schema="findFormField('living_room_table')"
                                                                        :error="getError('living_room_table')"
                                                                        @change="updateField('living_room_table', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="living_room_cabinet_disassembled"
                                                                        :defaultValue="form.living_room_cabinet_disassembled"
                                                                        :schema="findFormField('living_room_cabinet_disassembled')"
                                                                        :error="getError('living_room_cabinet_disassembled')"
                                                                        @change="updateField('living_room_cabinet_disassembled', $event)"
                                                        ></NumberIncField>
                                                        <!-- Add a Text Field -->
                                                        <InputField v-if="showCustomValueField" field-name="custom_value_living_room_cabinet_disassembled"
                                                                    :schema="findFormField('custom_value_living_room_cabinet_disassembled')"
                                                                    @change="updateField('custom_value_living_room_cabinet_disassembled', $event)"
                                                                    :error="getError('custom_value_living_room_cabinet_disassembled')"
                                                        ></InputField>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-collapse-wrapper>
                                        <v-collapse-wrapper>
                                            <div class="form-tab-header" v-collapse-toggle>
                                                <h3 class="tab-label">
                                                    <img class="tab-img" src="/uploads/0000/1/2024/02/27/wohn.png"/>
                                                    {{ trans('Packing Material') }}
                                                </h3>
                                            </div>
                                            <div class="form-tab-content" v-collapse-content>
                                                <h4 class="packing-m-title">{{ trans('Please enter here the total number of cartons to be transported') }}</h4>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h5>{{ trans('Moving cartoons') }}</h5>
                                                        <div class="form-box">
                                                            <NumberIncField field-name="cartoon_existing"
                                                                            :defaultValue="form.cartoon_existing"
                                                                            :schema="findFormField('cartoon_existing')"
                                                                            :error="getError('cartoon_existing')"
                                                                            @change="updateField('cartoon_existing', $event)"
                                                            ></NumberIncField>
                                                            <NumberIncField field-name="cartoon_needed"
                                                                            :defaultValue="form.cartoon_needed"
                                                                            :schema="findFormField('cartoon_needed')"
                                                                            :error="getError('cartoon_needed')"
                                                                            @change="updateField('cartoon_needed', $event)"
                                                            ></NumberIncField>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5>{{ trans('Book boxes') }}</h5>
                                                        <div class="form-box">
                                                            <NumberIncField field-name="book_boxes_existing"
                                                                            :defaultValue="form.book_boxes_existing"
                                                                            :schema="findFormField('book_boxes_existing')"
                                                                            :error="getError('book_boxes_existing')"
                                                                            @change="updateField('book_boxes_existing', $event)"
                                                            ></NumberIncField>
                                                            <NumberIncField field-name="book_boxes_needed"
                                                                            :defaultValue="form.book_boxes_needed"
                                                                            :schema="findFormField('book_boxes_needed')"
                                                                            :error="getError('book_boxes_needed')"
                                                                            @change="updateField('book_boxes_needed', $event)"
                                                            ></NumberIncField>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h5>{{ trans('Clothes hanging carton') }}</h5>
                                                        <div class="form-box">
                                                            <NumberIncField field-name="clothes_hanging_cartoon_existing"
                                                                            :defaultValue="form.clothes_hanging_cartoon_existing"
                                                                            :schema="findFormField('clothes_hanging_cartoon_existing')"
                                                                            :error="getError('clothes_hanging_cartoon_existing')"
                                                                            @change="updateField('clothes_hanging_cartoon_existing', $event)"
                                                            ></NumberIncField>
                                                            <NumberIncField field-name="clothes_hanging_cartoon_needed"
                                                                            :defaultValue="form.clothes_hanging_cartoon_needed"
                                                                            :schema="findFormField('clothes_hanging_cartoon_needed')"
                                                                            :error="getError('clothes_hanging_cartoon_needed')"
                                                                            @change="updateField('clothes_hanging_cartoon_needed', $event)"
                                                            ></NumberIncField>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <label><strong>{{ trans('Total') }}</strong></label>
                                                    <img class="total-sigma" src="/uploads/0000/1/2024/02/27/total.png">
                                                    <div class="mat6-en">
                                                    <span class="wpcf7-form-control-wrap">
                                                        <input type="text"
                                                               name="gesamt-hidden-en"
                                                               v-model="form.total_boxes"
                                                               :disabled="true"
                                                        />
                                                    </span>
                                                    </div>
                                                    <label class="txt-en">{{ trans("If you still need material or boxes, write a short note about it under the item 'Other' at the very bottom") }}</label>
                                                </div>
                                            </div>
                                        </v-collapse-wrapper>
                                        <v-collapse-wrapper>
                                            <div class="form-tab-header" v-collapse-toggle>
                                                <h3 class="tab-label">
                                                    <img class="tab-img" src="/uploads/0000/1/2024/02/27/arbeit.png"/>
                                                    {{ trans('Workroom') }}
                                                </h3>
                                            </div>
                                            <div class="form-tab-content" v-collapse-content>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="workroom_filing_cabinet"
                                                                        :defaultValue="form.workroom_filing_cabinet"
                                                                        :schema="findFormField('workroom_filing_cabinet')"
                                                                        :error="getError('workroom_filing_cabinet')"
                                                                        @change="updateField('workroom_filing_cabinet', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="workroom_edp"
                                                                        :defaultValue="form.workroom_edp"
                                                                        :schema="findFormField('workroom_edp')"
                                                                        :error="getError('workroom_edp')"
                                                                        @change="updateField('workroom_edp', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="workroom_desk_chair"
                                                                        :defaultValue="form.workroom_desk_chair"
                                                                        :schema="findFormField('workroom_desk_chair')"
                                                                        :error="getError('workroom_desk_chair')"
                                                                        @change="updateField('workroom_desk_chair', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="workroom_sofa_couch"
                                                                        :defaultValue="form.workroom_sofa_couch"
                                                                        :schema="findFormField('workroom_sofa_couch')"
                                                                        :error="getError('workroom_sofa_couch')"
                                                                        @change="updateField('workroom_sofa_couch', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="workroom_copying_machine"
                                                                        :defaultValue="form.workroom_copying_machine"
                                                                        :schema="findFormField('workroom_copying_machine')"
                                                                        :error="getError('workroom_copying_machine')"
                                                                        @change="updateField('workroom_copying_machine', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="workroom_angle_desk"
                                                                        :defaultValue="form.workroom_angle_desk"
                                                                        :schema="findFormField('workroom_angle_desk')"
                                                                        :error="getError('workroom_angle_desk')"
                                                                        @change="updateField('workroom_angle_desk', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="workroom_bookshelf"
                                                                        :defaultValue="form.workroom_bookshelf"
                                                                        :schema="findFormField('workroom_bookshelf')"
                                                                        :error="getError('workroom_bookshelf')"
                                                                        @change="updateField('workroom_bookshelf', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="workroom_desk"
                                                                        :defaultValue="form.workroom_desk"
                                                                        :schema="findFormField('workroom_desk')"
                                                                        :error="getError('workroom_desk')"
                                                                        @change="updateField('workroom_desk', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="workroom_armchair"
                                                                        :defaultValue="form.workroom_armchair"
                                                                        :schema="findFormField('workroom_armchair')"
                                                                        :error="getError('workroom_armchair')"
                                                                        @change="updateField('workroom_armchair', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="workroom_table"
                                                                        :defaultValue="form.workroom_table"
                                                                        :schema="findFormField('workroom_table')"
                                                                        :error="getError('workroom_table')"
                                                                        @change="updateField('workroom_table', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="workroom_sideboard"
                                                                        :defaultValue="form.workroom_sideboard"
                                                                        :schema="findFormField('workroom_sideboard')"
                                                                        :error="getError('workroom_sideboard')"
                                                                        @change="updateField('workroom_sideboard', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-collapse-wrapper>
                                        <v-collapse-wrapper>
                                            <div class="form-tab-header" v-collapse-toggle>
                                                <h3 class="tab-label">
                                                    <img class="tab-img" src="/uploads/0000/1/2024/02/27/sch.png"/>
                                                    {{ trans('Bedroom') }}
                                                </h3>
                                            </div>
                                            <div class="form-tab-content" v-collapse-content>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="bedroom_double_bed"
                                                                        :defaultValue="form.bedroom_double_bed"
                                                                        :schema="findFormField('bedroom_double_bed')"
                                                                        :error="getError('bedroom_double_bed')"
                                                                        @change="updateField('bedroom_double_bed', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="bedroom_single_bed"
                                                                        :defaultValue="form.bedroom_single_bed"
                                                                        :schema="findFormField('bedroom_single_bed')"
                                                                        :error="getError('bedroom_single_bed')"
                                                                        @change="updateField('bedroom_single_bed', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="bedroom_tv_table"
                                                                        :defaultValue="form.bedroom_tv_table"
                                                                        :schema="findFormField('bedroom_tv_table')"
                                                                        :error="getError('bedroom_tv_table')"
                                                                        @change="updateField('bedroom_tv_table', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="bedroom_side_table"
                                                                        :defaultValue="form.bedroom_side_table"
                                                                        :schema="findFormField('bedroom_side_table')"
                                                                        :error="getError('bedroom_side_table')"
                                                                        @change="updateField('bedroom_side_table', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="bedroom_cabinet"
                                                                        :defaultValue="form.bedroom_cabinet"
                                                                        :schema="findFormField('bedroom_cabinet')"
                                                                        :error="getError('bedroom_cabinet')"
                                                                        @change="updateField('bedroom_cabinet', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="bedroom_sliding_door_cabinet"
                                                                        :defaultValue="form.bedroom_sliding_door_cabinet"
                                                                        :schema="findFormField('bedroom_sliding_door_cabinet')"
                                                                        :error="getError('bedroom_sliding_door_cabinet')"
                                                                        @change="updateField('bedroom_sliding_door_cabinet', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="bedroom_tv"
                                                                        :defaultValue="form.bedroom_tv"
                                                                        :schema="findFormField('bedroom_tv')"
                                                                        :error="getError('bedroom_tv')"
                                                                        @change="updateField('bedroom_tv', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="bedroom_drawers"
                                                                        :defaultValue="form.bedroom_drawers"
                                                                        :schema="findFormField('bedroom_drawers')"
                                                                        :error="getError('bedroom_drawers')"
                                                                        @change="updateField('bedroom_drawers', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="bedroom_cabinet_to_door"
                                                                        :defaultValue="form.bedroom_cabinet_to_door"
                                                                        :schema="findFormField('bedroom_cabinet_to_door')"
                                                                        :error="getError('bedroom_cabinet_to_door')"
                                                                        @change="updateField('bedroom_cabinet_to_door', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="bedroom_chair"
                                                                        :defaultValue="form.bedroom_chair"
                                                                        :schema="findFormField('bedroom_chair')"
                                                                        :error="getError('bedroom_chair')"
                                                                        @change="updateField('bedroom_chair', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-collapse-wrapper>
                                        <v-collapse-wrapper>
                                            <div class="form-tab-header" v-collapse-toggle>
                                                <h3 class="tab-label">
                                                    <img class="tab-img" src="/uploads/0000/1/2024/02/27/kineder.png"/>
                                                    {{ trans('Children / guest room') }}
                                                </h3>
                                            </div>
                                            <div class="form-tab-content" v-collapse-content>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="guestroom_filing_cabinet"
                                                                        :defaultValue="form.guestroom_filing_cabinet"
                                                                        :schema="findFormField('guestroom_filing_cabinet')"
                                                                        :error="getError('guestroom_filing_cabinet')"
                                                                        @change="updateField('guestroom_filing_cabinet', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_bed"
                                                                        :defaultValue="form.guestroom_bed"
                                                                        :schema="findFormField('guestroom_bed')"
                                                                        :error="getError('guestroom_bed')"
                                                                        @change="updateField('guestroom_bed', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_bunk_bed"
                                                                        :defaultValue="form.guestroom_bunk_bed"
                                                                        :schema="findFormField('guestroom_bunk_bed')"
                                                                        :error="getError('guestroom_bunk_bed')"
                                                                        @change="updateField('guestroom_bunk_bed', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_drawer"
                                                                        :defaultValue="form.guestroom_drawer"
                                                                        :schema="findFormField('guestroom_drawer')"
                                                                        :error="getError('guestroom_drawer')"
                                                                        @change="updateField('guestroom_drawer', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_bedside_table"
                                                                        :defaultValue="form.guestroom_bedside_table"
                                                                        :schema="findFormField('guestroom_bedside_table')"
                                                                        :error="getError('guestroom_bedside_table')"
                                                                        @change="updateField('guestroom_bedside_table', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_dismountable_cabinet"
                                                                        :defaultValue="form.guestroom_dismountable_cabinet"
                                                                        :schema="findFormField('guestroom_dismountable_cabinet')"
                                                                        :error="getError('guestroom_dismountable_cabinet')"
                                                                        @change="updateField('guestroom_dismountable_cabinet', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_writing_desk"
                                                                        :defaultValue="form.guestroom_writing_desk"
                                                                        :schema="findFormField('guestroom_writing_desk')"
                                                                        :error="getError('guestroom_writing_desk')"
                                                                        @change="updateField('guestroom_writing_desk', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_toy_box"
                                                                        :defaultValue="form.guestroom_toy_box"
                                                                        :schema="findFormField('guestroom_toy_box')"
                                                                        :error="getError('guestroom_toy_box')"
                                                                        @change="updateField('guestroom_toy_box', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="guestroom_bookshelf"
                                                                        :defaultValue="form.guestroom_bookshelf"
                                                                        :schema="findFormField('guestroom_bookshelf')"
                                                                        :error="getError('guestroom_bookshelf')"
                                                                        @change="updateField('guestroom_bookshelf', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_bedding"
                                                                        :defaultValue="form.guestroom_bedding"
                                                                        :schema="findFormField('guestroom_bedding')"
                                                                        :error="getError('guestroom_bedding')"
                                                                        @change="updateField('guestroom_bedding', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_baby_crib"
                                                                        :defaultValue="form.guestroom_baby_crib"
                                                                        :schema="findFormField('guestroom_baby_crib')"
                                                                        :error="getError('guestroom_baby_crib')"
                                                                        @change="updateField('guestroom_baby_crib', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_playpen"
                                                                        :defaultValue="form.guestroom_playpen"
                                                                        :schema="findFormField('guestroom_playpen')"
                                                                        :error="getError('guestroom_playpen')"
                                                                        @change="updateField('guestroom_playpen', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_cabinet_to_door"
                                                                        :defaultValue="form.guestroom_cabinet_to_door"
                                                                        :schema="findFormField('guestroom_cabinet_to_door')"
                                                                        :error="getError('guestroom_cabinet_to_door')"
                                                                        @change="updateField('guestroom_cabinet_to_door', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_chair"
                                                                        :defaultValue="form.guestroom_chair"
                                                                        :schema="findFormField('guestroom_chair')"
                                                                        :error="getError('guestroom_chair')"
                                                                        @change="updateField('guestroom_chair', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_sofa"
                                                                        :defaultValue="form.guestroom_sofa"
                                                                        :schema="findFormField('guestroom_sofa')"
                                                                        :error="getError('guestroom_sofa')"
                                                                        @change="updateField('guestroom_sofa', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="guestroom_table"
                                                                        :defaultValue="form.guestroom_table"
                                                                        :schema="findFormField('guestroom_table')"
                                                                        :error="getError('guestroom_table')"
                                                                        @change="updateField('guestroom_table', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-collapse-wrapper>
                                        <v-collapse-wrapper>
                                            <div class="form-tab-header" v-collapse-toggle>
                                                <h3 class="tab-label">
                                                    <img class="tab-img" src="/uploads/0000/1/2024/02/27/kuche.png"/>
                                                    {{ trans('Kitchen/dining room') }}
                                                </h3>
                                            </div>
                                            <div class="form-tab-content" v-collapse-content>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="kitchen_worktop"
                                                                        :defaultValue="form.kitchen_worktop"
                                                                        :schema="findFormField('kitchen_worktop')"
                                                                        :error="getError('kitchen_worktop')"
                                                                        @change="updateField('kitchen_worktop', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_buffet_with_top"
                                                                        :defaultValue="form.kitchen_buffet_with_top"
                                                                        :schema="findFormField('kitchen_buffet_with_top')"
                                                                        :error="getError('kitchen_buffet_with_top')"
                                                                        @change="updateField('kitchen_buffet_with_top', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_corner_bench"
                                                                        :defaultValue="form.kitchen_corner_bench"
                                                                        :schema="findFormField('kitchen_corner_bench')"
                                                                        :error="getError('kitchen_corner_bench')"
                                                                        @change="updateField('kitchen_corner_bench', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_refrigerator_120l"
                                                                        :defaultValue="form.kitchen_refrigerator_120l"
                                                                        :schema="findFormField('kitchen_refrigerator_120l')"
                                                                        :error="getError('kitchen_refrigerator_120l')"
                                                                        @change="updateField('kitchen_refrigerator_120l', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_top_bottom"
                                                                        :defaultValue="form.kitchen_top_bottom"
                                                                        :schema="findFormField('kitchen_top_bottom')"
                                                                        :error="getError('kitchen_top_bottom')"
                                                                        @change="updateField('kitchen_top_bottom', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_chair"
                                                                        :defaultValue="form.kitchen_chair"
                                                                        :schema="findFormField('kitchen_chair')"
                                                                        :error="getError('kitchen_chair')"
                                                                        @change="updateField('kitchen_chair', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_dishwasher"
                                                                        :defaultValue="form.kitchen_dishwasher"
                                                                        :schema="findFormField('kitchen_dishwasher')"
                                                                        :error="getError('kitchen_dishwasher')"
                                                                        @change="updateField('kitchen_dishwasher', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_bar"
                                                                        :defaultValue="form.kitchen_bar"
                                                                        :schema="findFormField('kitchen_bar')"
                                                                        :error="getError('kitchen_bar')"
                                                                        @change="updateField('kitchen_bar', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="kitchen_broom"
                                                                        :defaultValue="form.kitchen_broom"
                                                                        :schema="findFormField('kitchen_broom')"
                                                                        :error="getError('kitchen_broom')"
                                                                        @change="updateField('kitchen_broom', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_buffet_without_top"
                                                                        :defaultValue="form.kitchen_buffet_without_top"
                                                                        :schema="findFormField('kitchen_buffet_without_top')"
                                                                        :error="getError('kitchen_buffet_without_top')"
                                                                        @change="updateField('kitchen_buffet_without_top', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_stove"
                                                                        :defaultValue="form.kitchen_stove"
                                                                        :schema="findFormField('kitchen_stove')"
                                                                        :error="getError('kitchen_stove')"
                                                                        @change="updateField('kitchen_stove', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_refrigerator_above120l"
                                                                        :defaultValue="form.kitchen_refrigerator_above120l"
                                                                        :schema="findFormField('kitchen_refrigerator_above120l')"
                                                                        :error="getError('kitchen_refrigerator_above120l')"
                                                                        @change="updateField('kitchen_refrigerator_above120l', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_microwave"
                                                                        :defaultValue="form.kitchen_microwave"
                                                                        :schema="findFormField('kitchen_microwave')"
                                                                        :error="getError('kitchen_microwave')"
                                                                        @change="updateField('kitchen_microwave', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_table"
                                                                        :defaultValue="form.kitchen_table"
                                                                        :schema="findFormField('kitchen_table')"
                                                                        :error="getError('kitchen_table')"
                                                                        @change="updateField('kitchen_table', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_freezer"
                                                                        :defaultValue="form.kitchen_freezer"
                                                                        :schema="findFormField('kitchen_freezer')"
                                                                        :error="getError('kitchen_freezer')"
                                                                        @change="updateField('kitchen_freezer', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="kitchen_sideboard"
                                                                        :defaultValue="form.kitchen_sideboard"
                                                                        :schema="findFormField('kitchen_sideboard')"
                                                                        :error="getError('kitchen_sideboard')"
                                                                        @change="updateField('kitchen_sideboard', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-collapse-wrapper>
                                        <v-collapse-wrapper>
                                            <div class="form-tab-header" v-collapse-toggle>
                                                <h3 class="tab-label">
                                                    <img class="tab-img" src="/uploads/0000/1/2024/02/27/bad.png"/>
                                                    {{ trans('Bathroom / hall / corridor') }}
                                                </h3>
                                            </div>
                                            <div class="form-tab-content" v-collapse-content>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="hall_toilet"
                                                                        :defaultValue="form.hall_toilet"
                                                                        :schema="findFormField('hall_toilet')"
                                                                        :error="getError('hall_toilet')"
                                                                        @change="updateField('hall_toilet', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="hall_chair"
                                                                        :defaultValue="form.hall_chair"
                                                                        :schema="findFormField('hall_chair')"
                                                                        :error="getError('hall_chair')"
                                                                        @change="updateField('hall_chair', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="hall_washing_machine"
                                                                        :defaultValue="form.hall_washing_machine"
                                                                        :schema="findFormField('hall_washing_machine')"
                                                                        :error="getError('hall_washing_machine')"
                                                                        @change="updateField('hall_washing_machine', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="hall_ironing_board"
                                                                        :defaultValue="form.hall_ironing_board"
                                                                        :schema="findFormField('hall_ironing_board')"
                                                                        :error="getError('hall_ironing_board')"
                                                                        @change="updateField('hall_ironing_board', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="hall_drawers"
                                                                        :defaultValue="form.hall_drawers"
                                                                        :schema="findFormField('hall_drawers')"
                                                                        :error="getError('hall_drawers')"
                                                                        @change="updateField('hall_drawers', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="hall_closet"
                                                                        :defaultValue="form.hall_closet"
                                                                        :schema="findFormField('hall_closet')"
                                                                        :error="getError('hall_closet')"
                                                                        @change="updateField('hall_closet', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="hall_cabinet_dismountable"
                                                                        :defaultValue="form.hall_cabinet_dismountable"
                                                                        :schema="findFormField('hall_cabinet_dismountable')"
                                                                        :error="getError('hall_cabinet_dismountable')"
                                                                        @change="updateField('hall_cabinet_dismountable', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="hall_vacuum_cleaner"
                                                                        :defaultValue="form.hall_vacuum_cleaner"
                                                                        :schema="findFormField('hall_vacuum_cleaner')"
                                                                        :error="getError('hall_vacuum_cleaner')"
                                                                        @change="updateField('hall_vacuum_cleaner', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="hall_wardrobe"
                                                                        :defaultValue="form.hall_wardrobe"
                                                                        :schema="findFormField('hall_wardrobe')"
                                                                        :error="getError('hall_wardrobe')"
                                                                        @change="updateField('hall_wardrobe', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="hall_shoe_cabinet"
                                                                        :defaultValue="form.hall_shoe_cabinet"
                                                                        :schema="findFormField('hall_shoe_cabinet')"
                                                                        :error="getError('hall_shoe_cabinet')"
                                                                        @change="updateField('hall_shoe_cabinet', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-collapse-wrapper>
                                        <v-collapse-wrapper>
                                            <div class="form-tab-header" v-collapse-toggle>
                                                <h3 class="tab-label">
                                                    <img class="tab-img" src="/uploads/0000/1/2024/02/27/keller.png"/>
                                                    {{ trans('Basement/storage') }}
                                                </h3>
                                            </div>
                                            <div class="form-tab-content" v-collapse-content>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="basement_stroller"
                                                                        :defaultValue="form.basement_stroller"
                                                                        :schema="findFormField('basement_stroller')"
                                                                        :error="getError('basement_stroller')"
                                                                        @change="updateField('basement_stroller', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="basement_shelf_dismountable"
                                                                        :defaultValue="form.basement_shelf_dismountable"
                                                                        :schema="findFormField('basement_shelf_dismountable')"
                                                                        :error="getError('basement_shelf_dismountable')"
                                                                        @change="updateField('basement_shelf_dismountable', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="basement_ski"
                                                                        :defaultValue="form.basement_ski"
                                                                        :schema="findFormField('basement_ski')"
                                                                        :error="getError('basement_ski')"
                                                                        @change="updateField('basement_ski', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="basement_tool_cabinet"
                                                                        :defaultValue="form.basement_tool_cabinet"
                                                                        :schema="findFormField('basement_tool_cabinet')"
                                                                        :error="getError('basement_tool_cabinet')"
                                                                        @change="updateField('basement_tool_cabinet', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="basement_suitcase"
                                                                        :defaultValue="form.basement_suitcase"
                                                                        :schema="findFormField('basement_suitcase')"
                                                                        :error="getError('basement_suitcase')"
                                                                        @change="updateField('basement_suitcase', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="basement_sledge"
                                                                        :defaultValue="form.basement_sledge"
                                                                        :schema="findFormField('basement_sledge')"
                                                                        :error="getError('basement_sledge')"
                                                                        @change="updateField('basement_sledge', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="basement_workbench"
                                                                        :defaultValue="form.basement_workbench"
                                                                        :schema="findFormField('basement_workbench')"
                                                                        :error="getError('basement_workbench')"
                                                                        @change="updateField('basement_workbench', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="basement_toolbox"
                                                                        :defaultValue="form.basement_toolbox"
                                                                        :schema="findFormField('basement_toolbox')"
                                                                        :error="getError('basement_toolbox')"
                                                                        @change="updateField('basement_toolbox', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-collapse-wrapper>
                                        <v-collapse-wrapper>
                                            <div class="form-tab-header" v-collapse-toggle>
                                                <h3 class="tab-label">
                                                    <img class="tab-img" src="/uploads/0000/1/2024/02/27/gara.png"/>
                                                    {{ trans('Garage / garden / balcony') }}
                                                </h3>
                                            </div>
                                            <div class="form-tab-content" v-collapse-content>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="garage_car_tires"
                                                                        :defaultValue="form.garage_car_tires"
                                                                        :schema="findFormField('garage_car_tires')"
                                                                        :error="getError('garage_car_tires')"
                                                                        @change="updateField('garage_car_tires', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="garage_tricycle"
                                                                        :defaultValue="form.garage_tricycle"
                                                                        :schema="findFormField('garage_tricycle')"
                                                                        :error="getError('garage_tricycle')"
                                                                        @change="updateField('garage_tricycle', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="garage_foldable_table"
                                                                        :defaultValue="form.garage_foldable_table"
                                                                        :schema="findFormField('garage_foldable_table')"
                                                                        :error="getError('garage_foldable_table')"
                                                                        @change="updateField('garage_foldable_table', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="garage_can"
                                                                        :defaultValue="form.garage_can"
                                                                        :schema="findFormField('garage_can')"
                                                                        :error="getError('garage_can')"
                                                                        @change="updateField('garage_can', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="garage_shelf"
                                                                        :defaultValue="form.garage_shelf"
                                                                        :schema="findFormField('garage_shelf')"
                                                                        :error="getError('garage_shelf')"
                                                                        @change="updateField('garage_shelf', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="garage_tt_table"
                                                                        :defaultValue="form.garage_tt_table"
                                                                        :schema="findFormField('garage_tt_table')"
                                                                        :error="getError('garage_tt_table')"
                                                                        @change="updateField('garage_tt_table', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="garage_flower_pot"
                                                                        :defaultValue="form.garage_flower_pot"
                                                                        :schema="findFormField('garage_flower_pot')"
                                                                        :error="getError('garage_flower_pot')"
                                                                        @change="updateField('garage_flower_pot', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="garage_bike"
                                                                        :defaultValue="form.garage_bike"
                                                                        :schema="findFormField('garage_bike')"
                                                                        :error="getError('garage_bike')"
                                                                        @change="updateField('garage_bike', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="garage_ladder"
                                                                        :defaultValue="form.garage_ladder"
                                                                        :schema="findFormField('garage_ladder')"
                                                                        :error="getError('garage_ladder')"
                                                                        @change="updateField('garage_ladder', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="garage_motor"
                                                                        :defaultValue="form.garage_motor"
                                                                        :schema="findFormField('garage_motor')"
                                                                        :error="getError('garage_motor')"
                                                                        @change="updateField('garage_motor', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="garage_wheelbarrow"
                                                                        :defaultValue="form.garage_wheelbarrow"
                                                                        :schema="findFormField('garage_wheelbarrow')"
                                                                        :error="getError('garage_wheelbarrow')"
                                                                        @change="updateField('garage_wheelbarrow', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-collapse-wrapper>
                                        <v-collapse-wrapper>
                                            <div class="form-tab-header" v-collapse-toggle>
                                                <h3 class="tab-label">
                                                    <img class="tab-img" src="/uploads/0000/1/2024/02/27/sons.png"/>
                                                    {{ trans('Others') }}
                                                </h3>
                                            </div>
                                            <div class="form-tab-content" v-collapse-content>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="other_ceiling_lamps"
                                                                        :defaultValue="form.other_ceiling_lamps"
                                                                        :schema="findFormField('other_ceiling_lamps')"
                                                                        :error="getError('other_ceiling_lamps')"
                                                                        @change="updateField('other_ceiling_lamps', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="other_pictures"
                                                                        :defaultValue="form.other_pictures"
                                                                        :schema="findFormField('other_pictures')"
                                                                        :error="getError('other_pictures')"
                                                                        @change="updateField('other_pictures', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="other_plants"
                                                                        :defaultValue="form.other_plants"
                                                                        :schema="findFormField('other_plants')"
                                                                        :error="getError('other_plants')"
                                                                        @change="updateField('other_plants', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="other_mirror"
                                                                        :defaultValue="form.other_mirror"
                                                                        :schema="findFormField('other_mirror')"
                                                                        :error="getError('other_mirror')"
                                                                        @change="updateField('other_mirror', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <NumberIncField field-name="other_floor_lamps"
                                                                        :defaultValue="form.other_floor_lamps"
                                                                        :schema="findFormField('other_floor_lamps')"
                                                                        :error="getError('other_floor_lamps')"
                                                                        @change="updateField('other_floor_lamps', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="other_carpet"
                                                                        :defaultValue="form.other_carpet"
                                                                        :schema="findFormField('other_carpet')"
                                                                        :error="getError('other_carpet')"
                                                                        @change="updateField('other_carpet', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="other_plants_over_1m"
                                                                        :defaultValue="form.other_plants_over_1m"
                                                                        :schema="findFormField('other_plants_over_1m')"
                                                                        :error="getError('other_plants_over_1m')"
                                                                        @change="updateField('other_plants_over_1m', $event)"
                                                        ></NumberIncField>
                                                        <NumberIncField field-name="other_fitness_equipment"
                                                                        :defaultValue="form.other_fitness_equipment"
                                                                        :schema="findFormField('other_fitness_equipment')"
                                                                        :error="getError('other_fitness_equipment')"
                                                                        @change="updateField('other_fitness_equipment', $event)"
                                                        ></NumberIncField>
                                                    </div>
                                                </div>
                                            </div>
                                        </v-collapse-wrapper>
                                    </v-collapse-group>
                                    <div class="addition-note-box">
                                        <h6>{{ trans('What else is important:') }}</h6>
                                        <TextareaField field-name="additional_object"
                                                       :defaultValue="form.additional_object"
                                                       :schema="findFormField('additional_object')"
                                                       :error="getError('additional_object')"
                                                       @change="updateField('additional_object', $event)"
                                        ></TextareaField>
                                        <div class="step-buttons packing-list-btn clearfix">
                                            <button @click.prevent="prev()"
                                                    class="btn btn-primary btn-prev float-left"
                                            >
                                                {{ trans("Previous") }}
                                            </button>
                                            <button class="btn btn-primary btn-next float-right"
                                                    @click.prevent="registerForm()"
                                            >{{ trans('Request a personal offer!') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="box-section">
                                        <h3 class="vol-title">{{ trans('Your loading volume') }}</h3>
                                        <div class="blitz-road-en">
                                            <img width="226" height="100" class="car-blitz-en" src="/uploads/0000/1/2024/09/18/meissner-entruempelung-truck.webp"/>
                                        </div>
                                        <div class="inventory-volume-en">{{ trans('Cargo') }}: {{ getTotalEvaluation() }}m³</div>
                                        <div class="inventory-vol-detail">
                                            <template v-for="forms in formSchema">
                                                <template v-if="hasFormItems(forms.forms)">
                                                    <div class="inventory-group">
                                                        <div class="inventory-group-title">{{ forms.group }}</div>
                                                        <div class="inventory-group-item">
                                                            <template v-for="form in forms.forms">
                                                                <template v-if="__has(form, 'value') && __has(form, 'group') && form.type === 'number' && form.value > 0">
                                                                    <div class="clearfix">
                                                                        <div class="float-left">
                                                                            {{ form.value }}x {{ form.label }}
                                                                        </div>
                                                                        <div class="float-right">{{ form.unit }}m³</div>
                                                                    </div>
                                                                </template>
                                                            </template>
                                                        </div>
                                                        <div class="inventory-group-summary" v-if="forms.group == trans('Moving boxes')">
                                                            {{ trans('Total moving boxes') }}: {{ totalBoxes }}
                                                        </div>
                                                    </div>
                                                </template>
                                            </template>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </section>
                </transition>

            </section>
        </template>
        <template v-else>
            <div id="form_b4c0bf9ac3" class="thank-you-message">
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
import AutocompleteAddress from "./__googlemap/AutocompleteAddress.vue";
import BooleanCheckboxField from "./__inc/BooleanCheckboxField.vue";
import NumberIncField from "./__inc/NumberIncField.vue";
import InputNumberField from "./__inc/InputNumberField.vue";

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
        InputNumberField,
        NumberIncField,
        BooleanCheckboxField,
        AutocompleteAddress,
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

    computed: {
        totalBoxes: function () {
            let total = 0;
            total += Number(this.form.cartoon_existing);
            total += Number(this.form.cartoon_needed);
            total += Number(this.form.book_boxes_existing);
            total += Number(this.form.book_boxes_needed);
            total += Number(this.form.clothes_hanging_cartoon_existing);
            total += Number(this.form.clothes_hanging_cartoon_needed);
            this.form.total_boxes = total;
            return total;
        }
    },

    watch: {
        /*'form.moving_date_to': function (val) {
            console.log("Moving date from"+ this.form.moving_date_from);
            console.log("Moving date to"+ val);
        },*/
    },

    data() {
        return {
            loader: null,
            showForm: true,
            formSchema: [],
            form: {
                total_step: 4,
                step: 1,
                lang: this.config.lang,

                mover_type: "",
                from_street: "",
                from_postal_code: "",
                from_city: "",
                from_country: "",
                has_via_address: false,
                via_street: "",
                via_postal_code: "",
                via_city: "",
                via_country: "",
                has_not_to_address: false,
                to_street: "",
                to_postal_code: "",
                to_city: "",
                to_country: "",

                from_lives_in: "",
                from_total_persons: "",
                from_floor: "",
                from_has_elevator: "",
                from_fit_items_in_elevator: "",
                from_elevator_size: "",
                from_elevator_size_unit: "",
                from_total_rooms: "",
                from_no_stopping: "",
                from_furniture_disassemble: "",
                from_furniture_disassemble_detail: "",
                from_living_space: "",
                from_kitchen_disassemble: "",
                from_kitchen_disassemble_detail: "",
                from_packing_cartons: "",
                to_move_to: "",
                to_floor: "",
                to_has_elevator: "",
                to_fit_items_in_elevator: "",
                to_elevator_size: "",
                to_elevator_size_unit: "",
                to_no_stopping: "",
                to_furniture_assemble: "",
                to_furniture_assemble_detail: "",
                to_unpack_boxes: "",
                assemble_kitchen: "",
                moving_date: "",
                moving_date_from: "",
                moving_date_to: "",
                reach_title: "",
                reach_name: "",
                reach_telephone: "",
                reach_email: "",
                reach_cost: "",

                from_carrying_distance: "",
                from_staircase: "",
                from_house_position: "",
                from_loading_note: "",
                to_carrying_distance: "",
                to_staircase: "",
                to_house_position: "",
                to_loading_note: "",

                living_room_wall_unit: "",
                living_room_buffet: "",
                living_room_tv_others: "",
                living_room_wing: "",
                living_room_solid_desk: "",
                living_room_sideboard_display_case: "",
                living_room_sofa_couch: "",
                living_room_chair: "",
                living_room_video_console: "",
                living_room_e_piano: "",
                living_room_bookshelf: "",
                living_room_buffet_without_attachment: "",
                living_room_living_tv_table: "",
                living_room_piano: "",
                living_room_desk_not_solid: "",
                living_room_arm_chair: "",
                living_room_old_clock: "",
                living_room_table: "",
                living_room_cabinet_disassembled: "",
                custom_value_living_room_cabinet_disassembled: '',
                cartoon_existing: "",
                cartoon_needed: "",
                book_boxes_existing: "",
                book_boxes_needed: "",
                clothes_hanging_cartoon_existing: "",
                clothes_hanging_cartoon_needed: "",
                total_boxes: 0,
                workroom_filing_cabinet: "",
                workroom_edp: "",
                workroom_desk_chair: "",
                workroom_sofa_couch: "",
                workroom_copying_machine: "",
                workroom_angle_desk: "",
                workroom_bookshelf: "",
                workroom_desk: "",
                workroom_armchair: "",
                workroom_table: "",
                workroom_sideboard: "",

                bedroom_double_bed: "",
                bedroom_single_bed: "",
                bedroom_tv_table: "",
                bedroom_side_table: "",
                bedroom_cabinet: "",
                bedroom_sliding_door_cabinet: "",
                bedroom_tv: "",
                bedroom_drawers: "",
                bedroom_cabinet_to_door: "",
                bedroom_chair: "",

                guestroom_filing_cabinet: "",
                guestroom_bed: "",
                guestroom_bunk_bed: "",
                guestroom_drawer: "",
                guestroom_bedside_table: "",
                guestroom_dismountable_cabinet: "",
                guestroom_writing_desk: "",
                guestroom_toy_box: "",
                guestroom_bookshelf: "",
                guestroom_bedding: "",
                guestroom_baby_crib: "",
                guestroom_playpen: "",
                guestroom_cabinet_to_door: "",
                guestroom_chair: "",
                guestroom_sofa: "",
                guestroom_table: "",
                kitchen_worktop: "",
                kitchen_buffet_with_top: "",
                kitchen_corner_bench: "",
                kitchen_refrigerator_120l: "",
                kitchen_top_bottom: "",
                kitchen_chair: "",
                kitchen_dishwasher: "",
                kitchen_bar: "",
                kitchen_broom: "",
                kitchen_buffet_without_top: "",
                kitchen_stove: "",
                kitchen_refrigerator_above120l: "",
                kitchen_microwave: "",
                kitchen_table: "",
                kitchen_freezer: "",
                kitchen_sideboard: "",
                hall_toilet: "",
                hall_chair: "",
                hall_washing_machine: "",
                hall_ironing_board: "",
                hall_drawers: "",
                hall_closet: "",
                hall_cabinet_dismountable: "",
                hall_vacuum_cleaner: "",
                hall_wardrobe: "",
                hall_shoe_cabinet: "",
                basement_stroller: "",
                basement_shelf_dismountable: "",
                basement_ski: "",
                basement_tool_cabinet: "",
                basement_suitcase: "",
                basement_sledge: "",
                basement_workbench: "",
                basement_toolbox: "",
                garage_car_tires: "",
                garage_tricycle: "",
                garage_foldable_table: "",
                garage_can: "",
                garage_shelf: "",
                garage_tt_table: "",
                garage_flower_pot: "",
                garage_bike: "",
                garage_ladder: "",
                garage_motor: "",
                garage_wheelbarrow: "",

                other_ceiling_lamps: "",
                other_pictures: "",
                other_plants: "",
                other_mirror: "",
                other_floor_lamps: "",
                other_carpet: "",
                other_plants_over_1m: "",
                other_fitness_equipment: "",
                additional_object: "",
                total_moving_object: 0,

                terms: '',
            },
            errors: [],
            googleMap: null,
            directionsService: null,
            directionsRenderer: null,
            summaryPanel: '',
            showCustomValueField: false
        };
    },

    created() {
        this.getFormDefaultValues();
        this.formSchema = this.getModifiedSchema();
    },

    mounted() {
        this.initGoogleMap();
        this.$refs.firstAccordion.open();
    },

    methods: {

        getTotalEvaluation() {
            let total = 0;
            for (const forms of this.formSchema) {
                for (const form of forms.forms) {
                    if (this.__has(form, 'value') && this.__has(form, 'group') && form.type === 'number' && form.value > 0) {
                        total += (form.unit * form.value);
                    }
                }
            }
            total = Number(total.toFixed(2));

            this.form.total_moving_object = total;

            return total;
        },

        getModifiedSchema() {
            let result = Object.groupBy(this.schema, ({ group }) => group);
            let forms = [];
            for (const groupName of Object.keys(result)) {
                if (groupName != 'undefined') {
                    forms.push({
                        group: groupName,
                        forms: result[groupName]
                    });
                }
            }
            return forms;
        },

        hasFormItems(forms) {
            for (const form of forms) {
                if (this.__has(form, 'value') && this.__has(form, 'group') && form.type === 'number' && form.value > 0) {
                    return true;
                }
            }
            return false;
        },

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

        updateFromAddress(address) {
            this.form.from_street = address.street;
            this.form.from_postal_code = address.postal_code;
            this.form.from_city = address.city;
            this.form.from_country = address.country;
            this.calculateAndDisplayRoute();
        },

        updateViaAddress(address) {
            this.form.via_street = address.street;
            this.form.via_postal_code = address.postal_code;
            this.form.via_city = address.city;
            this.form.via_country = address.country;
            this.calculateAndDisplayRoute();
        },

        updateToAddress(address) {
            this.form.to_street = address.street;
            this.form.to_postal_code = address.postal_code;
            this.form.to_city = address.city;
            this.form.to_country = address.country;
            this.calculateAndDisplayRoute();
        },

        toggleViaAddress() {
            this.form.has_via_address = !this.form.has_via_address;

            if (!this.form.has_via_address) {
                this.form.via_street = '';
                this.form.via_postal_code = '';
                this.form.via_city = '';
                this.form.via_country = '';

                if (!this.form.to_street) {
                    this.removeMapDirectionService();
                } else {
                    this.calculateAndDisplayRoute();
                }
            }
        },

        updateHasNotToAddress(key, value) {
            for (const formKey of Object.keys(this.form)) {
                if (formKey === key) {
                    this.form[key] = value;

                    if (value) {
                        this.form.to_street = '';
                        this.form.to_postal_code = '';
                        this.form.to_city = '';
                        this.form.to_country = '';

                        if (!this.form.to_street && !this.form.via_street) {
                            this.removeMapDirectionService();
                        } else {
                            this.calculateAndDisplayRoute();
                        }
                    }
                }
            }
        },

        removeMapDirectionService() {
            this.directionsRenderer.setMap(null);
            this.summaryPanel = '';
        },

        initGoogleMap() {

            this.directionsService = new google.maps.DirectionsService();
            this.directionsRenderer = new google.maps.DirectionsRenderer();
            this.googleMap = new google.maps.Map(document.getElementById("google-map"), {
                zoom: 6,
                center: { lat: 51.165691, lng: 10.451526 },
            });
        },

        calculateAndDisplayRoute() {

            if (this.form.from_street && (this.form.to_street || this.form.via_street)) {

                this.directionsRenderer.setMap(this.googleMap);

                const hasToAddress = !!this.form.to_street;

                const waypoints = [];

                if (this.form.via_street && hasToAddress) {
                    waypoints.push({
                        location: this.form.via_street,
                        stopover: true,
                    });
                }

                this.directionsService
                    .route({
                        origin: this.form.from_street, //{query: this.form.from_street,},
                        destination: hasToAddress ? this.form.to_street : this.form.via_street, //{query: hasToAddress ? this.form.to_street : this.form.via_street,},
                        waypoints: waypoints,
                        optimizeWaypoints: true,
                        travelMode: google.maps.TravelMode.DRIVING,
                        unitSystem: google.maps.UnitSystem.METRIC
                    })
                    .then((response) => {
                        this.directionsRenderer.setDirections(response);

                        let totalDistance = 0;
                        this.summaryPanel = '';

                        // For each route, display summary information.
                        let routeSegment = 1;
                        for (let route of response.routes[0].legs) {

                            this.summaryPanel += "<div class='rout-name'><strong>" + this.trans('Route section') + " " + (routeSegment++) + ":</strong></div>";
                            this.summaryPanel += route.start_address + " <i class='distance-spacer'></i> ";
                            this.summaryPanel += route.end_address + "<br>";
                            this.summaryPanel += "<div> <strong>" + this.trans('Distance') + ": </strong>" + this.formatNumberAsPerLocale(route.distance.text) + " km </div><br><br>";

                            totalDistance += parseFloat(route.distance.text);
                        }
                        this.summaryPanel += "<div><strong>" + this.trans('Total Distance') + ": </strong>" + this.formatNumberAsPerLocale(totalDistance) + " km </div>";
                    })
                    .catch((e) => {
                    });
            }
        },

        formatNumberAsPerLocale(number) {
            return (parseFloat(number)).toLocaleString(
                this.config.lang, // leave undefined to use the visitor's browser
                // locale or a string like 'en-US' to override it.
                { minimumFractionDigits: 2 }
            )
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

                let validations = this.__has(field, 'validation') ? field.validation : false;

                if (!validations) {
                    continue;
                }

                for (const validation of validations) {
                    if (validation === 'required') {
                        let fieldValue = this.__has(this.form, key) ? this.form[key] : null;

                        if (!fieldValue) {
                            result = false;
                            this.setError(key, this.getValidationMessage(field, 'required', this.trans('This field is required')));
                        }
                    }

                    if (validation === 'alpha_num_symbol') {

                        let fieldValue = this.__has(this.form, key) ? this.form[key] : null;
                        if (fieldValue) {
                            let numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
                            let value = fieldValue.replace(/[^0-9]/g,'');
                            if (!numberRegex.test(value)) {
                                result = false;
                                this.setError(key, this.getValidationMessage(field, 'alpha_num_symbol', this.trans('Street and house no is required')));
                            }
                        } else{
                            result = false;
                            this.setError(key, this.getValidationMessage(field, 'alpha_num_symbol', this.trans('Street and house no is required')));
                        }
                    }

                }
            }

            if (!result) {
                this.alertToast(this.trans('Validation error'), this.trans('Error!!'), 'error');
            }

            return result;
        },

        getValidationMessage(field, validationKey, defaultMessage) {
            let validationMessages =  this.__has(field, 'messages') ? (this.__is_Object(field['messages']) ? field['messages'] : {}) : {};
            for (const key of Object.keys(validationMessages)) {
                if (key === validationKey) {
                    return validationMessages[key];
                }
            }
            return defaultMessage;
        },

        setError(key, message) {
            let hasKey = false;
            for (const error of this.errors) {
                if (this.__has(error, 'name') && error.name === key) {
                    hasKey = true;
                    error.errors.push(message);
                }
            }

            if (!hasKey) {
                this.errors.push({
                    name: key,
                    errors: [message]
                })
            }
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

        changeOnMovingDate() {
            this.form.moving_date_from = '';
            this.form.moving_date_to = '';
        },

        updateField(key, value) {
            if (this.__has(this.form, key)) {
                this.form[key] = value;
                for (const formGroup of this.formSchema) {
                    for (const field of formGroup.forms) {
                        if (field.type === 'number' && field.name === key) {
                            field.value = value;
                            break;
                        }
                    }
                }
            }
            if (key === 'living_room_cabinet_disassembled' && value > 0) {
              this.showCustomValueField = true; // Show custom field for specific cases
            }
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

            if (!this.isValidInputs(this.getFourthStepFields())) {
                return;
            }

            if (this.getTotalEvaluation() == 0 && this.form.additional_object == '') {
                this.alertToast(this.trans('Either box packing or description required'), '', 'error');
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
                mover_type: "",
                from_street: "",
                from_postal_code: "",
                from_city: "",
                from_country: "",
                via_street: "",
                via_postal_code: "",
                via_city: "",
                via_country: "",
                has_not_to_address: false,
                to_street: "",
                to_postal_code: "",
                to_city: "",
                to_country: "",
            };
        },

        getSecondStepFields() {
            return {
                from_lives_in: "",
                from_total_persons: "",
                from_floor: "",
                from_has_elevator: "",
                from_fit_items_in_elevator: "",
                from_elevator_size: "",
                from_elevator_size_unit: "",
                from_total_rooms: "",
                from_no_stopping: "",
                from_furniture_disassemble: "",
                from_furniture_disassemble_detail: "",
                from_living_space: "",
                from_kitchen_disassemble: "",
                from_kitchen_disassemble_detail: "",
                from_packing_cartons: "",
                to_move_to: "",
                to_floor: "",
                to_has_elevator: "",
                to_fit_items_in_elevator: "",
                to_elevator_size: "",
                to_elevator_size_unit: "",
                to_no_stopping: "",
                to_furniture_assemble: "",
                to_furniture_assemble_detail: "",
                to_unpack_boxes: "",
                assemble_kitchen: "",
                moving_date: "",
                moving_date_from: "",
                moving_date_to: "",
                reach_title: "",
                reach_name: "",
                reach_telephone: "",
                reach_email: "",
                reach_cost: "",
            };
        },

        getThirdStepFields() {
            return {
                from_carrying_distance: "",
                from_staircase: "",
                from_house_position: "",
                from_loading_note: "",
                to_carrying_distance: "",
                to_staircase: "",
                to_house_position: "",
                to_loading_note: "",
            };
        },

        getFourthStepFields() {
            return {
                living_room_wall_unit: "",
                living_room_buffet: "",
                living_room_tv_others: "",
                living_room_wing: "",
                living_room_solid_desk: "",
                living_room_sideboard_display_case: "",
                living_room_sofa_couch: "",
                living_room_chair: "",
                living_room_video_console: "",
                living_room_e_piano: "",
                living_room_bookshelf: "",
                living_room_buffet_without_attachment: "",
                living_room_living_tv_table: "",
                living_room_piano: "",
                living_room_desk_not_solid: "",
                living_room_arm_chair: "",
                living_room_old_clock: "",
                living_room_table: "",
                living_room_cabinet_disassembled: "",
                cartoon_existing: "",
                cartoon_needed: "",
                book_boxes_existing: "",
                book_boxes_needed: "",
                clothes_hanging_cartoon_existing: "",
                clothes_hanging_cartoon_needed: "",
                workroom_filing_cabinet: "",
                workroom_edp: "",
                workroom_desk_chair: "",
                workroom_sofa_couch: "",
                workroom_copying_machine: "",
                workroom_angle_desk: "",
                workroom_bookshelf: "",
                workroom_desk: "",
                workroom_armchair: "",
                workroom_table: "",
                workroom_sideboard: "",

                bedroom_double_bed: "",
                bedroom_single_bed: "",
                bedroom_tv_table: "",
                bedroom_side_table: "",
                bedroom_cabinet: "",
                bedroom_sliding_door_cabinet: "",
                bedroom_tv: "",
                bedroom_drawers: "",
                bedroom_cabinet_to_door: "",
                bedroom_chair: "",

                guestroom_filing_cabinet: "",
                guestroom_bed: "",
                guestroom_bunk_bed: "",
                guestroom_drawer: "",
                guestroom_bedside_table: "",
                guestroom_dismountable_cabinet: "",
                guestroom_writing_desk: "",
                guestroom_toy_box: "",
                guestroom_bookshelf: "",
                guestroom_bedding: "",
                guestroom_baby_crib: "",
                guestroom_playpen: "",
                guestroom_cabinet_to_door: "",
                guestroom_chair: "",
                guestroom_sofa: "",
                guestroom_table: "",
                kitchen_worktop: "",
                kitchen_buffet_with_top: "",
                kitchen_corner_bench: "",
                kitchen_refrigerator_120l: "",
                kitchen_top_bottom: "",
                kitchen_chair: "",
                kitchen_dishwasher: "",
                kitchen_bar: "",
                kitchen_broom: "",
                kitchen_buffet_without_top: "",
                kitchen_stove: "",
                kitchen_refrigerator_above120l: "",
                kitchen_microwave: "",
                kitchen_table: "",
                kitchen_freezer: "",
                kitchen_sideboard: "",
                hall_toilet: "",
                hall_chair: "",
                hall_washing_machine: "",
                hall_ironing_board: "",
                hall_drawers: "",
                hall_closet: "",
                hall_cabinet_dismountable: "",
                hall_vacuum_cleaner: "",
                hall_wardrobe: "",
                hall_shoe_cabinet: "",
                basement_stroller: "",
                basement_shelf_dismountable: "",
                basement_ski: "",
                basement_tool_cabinet: "",
                basement_suitcase: "",
                basement_sledge: "",
                basement_workbench: "",
                basement_toolbox: "",
                garage_car_tires: "",
                garage_tricycle: "",
                garage_foldable_table: "",
                garage_can: "",
                garage_shelf: "",
                garage_tt_table: "",
                garage_flower_pot: "",
                garage_bike: "",
                garage_ladder: "",
                garage_motor: "",
                garage_wheelbarrow: "",

                other_ceiling_lamps: "",
                other_pictures: "",
                other_plants: "",
                other_mirror: "",
                other_floor_lamps: "",
                other_carpet: "",
                other_plants_over_1m: "",
                other_fitness_equipment: "",
                additional_object: "",
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
