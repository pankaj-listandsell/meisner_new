<template>
    <div class="auto-complete-input">
        <input type="text"
               :value="defaultValue"
               class="form-control"
               ref="autocompleteInput"
               :required="isRequired()"
               :placeholder="getPlaceholder()"
               :disabled="disabledStatus"
               @input="$emit('change', $event.target.value)"
        />
        <ErrorBox :error="error"></ErrorBox>
    </div>
</template>

<script>

import ErrorBox from "../__inc/ErrorBox.vue";
import AppHelper from "../../../admin/js/mixins/AppHelper";

export default {
    components: {ErrorBox},

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

    mixins: [AppHelper],

    data() {
        return {
            fieldValue: '',
            autocomplete: null,
            disabledStatus: false,
        }
    },

    mounted() {
        this.initSearchBox();
    },

    created() {
        this.disabledStatus = Boolean(this.disabled)
    },

    updated() {
        this.disabledStatus = Boolean(this.disabled);
    },

    methods: {

        initSearchBox() {
            // Create the search box and link it to the UI element.
            this.autocomplete = new google.maps.places.Autocomplete(
                this.$refs.autocompleteInput, {
                    /*componentRestrictions: { country: ["de"] },*/
                    types: ['address'],
                    fields: ["address_components"],
                    strictBounds: false,
                }
            );


            this.autocomplete.addListener("place_changed", this.getPlaceAddress);

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    let geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    let circle = new google.maps.Circle({center: geolocation, radius: position.coords.accuracy});
                    this.autocomplete.setBounds(circle.getBounds());
                });
            }
        },

        getPlaceAddress() {

            const place = this.autocomplete.getPlace();
            let route = '', street = '', address = '', postcode = '', city = '', state = '', country = "";

            //http://goo.gle/3l5i5Mr
            for (const component of place.address_components) {

                const componentType = component.types[0];

                switch (componentType) {

                    /*case "premise": {
                        address += (address ? ', ' : '') + `${component.long_name}`;
                        break;
                    }

                    case "natural_feature": {
                        address += (address ? ', ' : '') + `${component.long_name}`;
                        break;
                    }*/

                    case "route": {
                        route = component.long_name;
                        break;
                    }

                    case "street_number": {
                        street = component.long_name;
                        break;
                    }

                    /*case "sublocality_level_1": {
                        address += (address ? ', ' : '') + `${component.long_name}`;
                        break;
                    }*/

                    /*case "sublocality": {
                        address += ` ${component.long_name}`;
                        break;
                    }*/

                    case "postal_code": {
                        postcode = `${component.long_name}`;
                        break;
                    }

                    case "locality":
                        city = component.long_name;
                        break;

                    case "administrative_area_level_1": {
                        state = component.short_name;
                        break;
                    }

                    case "country":
                        country = component.long_name;
                        break;
                }
            }
            address = route + ' ' + street;

            return this.$emit('selected', {
                street: address,
                postal_code: postcode,
                city: city,
                country: country
            })
        },

        getPlaceholder() {
            return this.__has(this.schema, 'placeholder') ? this.schema.placeholder : '';
        },

        isRequired() {
            return this.__has(this.schema, 'required') ? !!this.schema.required : false;
        }
    },


}
</script>

<style>
</style>
