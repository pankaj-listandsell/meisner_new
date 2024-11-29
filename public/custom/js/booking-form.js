let calendar, lastId, bookingForm;

Vue.use(VeeValidate);

const dict = {
    attributes: {
        first_name: 'First Name',
        last_name: 'Last Name'
    },
    custom: {
        tour: {
            required: 'Please select tour'
        },
    }
};

VeeValidate.Validator.localize(dict);
Vue.use(VueLoading);

bookingForm = new Vue({
    el: "#booking_form_div",
    components: {
        vuejsDatepicker,
        'loading': VueLoading,
    },
    data: () => {
        return {
            tours: [],
            tourSelected: {
                id: '',
                title: '',
                transport_ids: [],
                left_person: 100,
            },
            tourDate: {
                startDate: new Date(),
                disabledDates: {to: new Date(Date.now() - 8640000), dates: [],},
                date: null,
            },
            transports: [],
            hotels: [],
            countries: [],
            form: {
                step: 1,
                tour_id: '',
                tour_date: null,
                members: [],
                transport_id: 0,
                transport_type: 0,
                discount_type: 'fixed_amount',
                discount: 0,
                transport: {
                    street_no: '',
                    postal_code: '',
                    city: '',
                    hotel_id: 0,
                    hotel_name: '',
                    hotel_room_no: '',
                    hotel_phone_no: '',
                    hotel_address: '',
                },
                customer: {
                    first_name: "",
                    last_name: "",
                    email: "",
                    phone_no: "",
                    mobile_no: "",
                    nationality: "",
                    address: "",
                    city: "",
                    postal_code: "",
                    country: "",
                    additional_contact: [
                        {
                            name: 'Whatsapp',
                            key: 'whatsapp',
                            contact_no: '',
                            selected: 0,
                        },
                        {
                            name: 'Viber',
                            key: 'viber',
                            contact_no: '',
                            selected: 0,
                        },
                        {
                            name: 'WeChat',
                            key: 'wechat',
                            contact_no: '',
                            selected: 0,
                        },
                        {
                            name: 'Line',
                            key: 'line',
                            contact_no: '',
                            selected: 0,
                        },
                        {
                            name: 'Skype',
                            key: 'skype',
                            contact_no: '',
                            selected: 0,
                        },
                    ],
                    notes: "",
                },
                payment_deposit_type: 'full_payment',
                payment_transaction_id: 0,
                payment_details: {},
                sub_total: 0,
                discount_total: 0,
                grand_total: 0,
            },
            steps: {},
            hasSeenCongrats: false,
            isPaymentCompleted: false,
            showPaypalPayment: true,
            isLoading: true,
        };
    },
    async created() {
        //this.clearStorageObject();

        if (!this.issetStorageKey()) {
            this.setDefaultStorageObject();
        } else {
            this.setFormDataFromStorageObject();
        }
        this.hotels = window.booking_form.hotels;
        this.transports = window.booking_form.transports;
        this.countries = window.booking_form.countries;
        await this.setDefaultTours();
        if (this.form.tour_id != '') {
            await this.setSelectedTourById(this.form.tour_id);
        }
        if (this.form.tour_date != null) {
            await this.setDatePickerDate(new Date(this.form.tour_date));
        }
        jQuery(document).on('ready', function () {
            this.isLoading = false;
        });
    },

    mounted() {
        this.setUpPaypalPayment();
    },

    methods: {

        inArray(needle, haystack) {
            var length = haystack.length;
            for(var i = 0; i < length; i++) {
                if(haystack[i] == needle) return true;
            }
            return false;
        },


        setDatePickerDate(date) {
            this.tourDate.date = date;
        },

        setTours(tours) {
            this.tours = tours;
        },

        getDefaultTours() {
            return localStorage.getItem('tours') == null ? [] : (JSON.parse(localStorage.getItem('tours')));
        },

        setDefaultTours() {
            this.tours = this.getDefaultTours();
        },

        setToursInLocalStorage() {
            localStorage.setItem('tours', JSON.stringify(this.tours));
        },

        setFormDataFromStorageObject() {
            this.form = this.getStorageObject();
        },

        getStorageKey() {
            return 'booking_store'
        },

        issetStorageKey() {
            return this.getStorageObject() != null;
        },

        getStorageObject() {
            var storageObj = localStorage.getItem(this.getStorageKey());

            if (storageObj == null) {
                return null;
            }

            return JSON.parse(storageObj);
        },

        getDefaultStorageObject() {
            return this.form;
        },

        setDefaultStorageObject() {
            localStorage.setItem(this.getStorageKey(), JSON.stringify(this.getDefaultStorageObject()));
        },

        setFormDataToStorageObject() {
            localStorage.setItem(this.getStorageKey(), JSON.stringify(this.form));
        },

        clearStorageObject() {
            //return localStorage.removeItem(this.getStorageKey());
            return localStorage.clear();
        },

        getTransportNameByType(transportType) {
            switch (transportType) {
                case 'own_pickup':
                    return 'Own Pickup'
                case 'own_travel':
                    return 'Own Travel';
                case 'hotel':
                    return "Hotel";
                default:
                    return 'Hotel not booked yet';
            }
        },

        hasDiscount() {
            return this.form.discount > 0;
        },

        getStorageItem(key, defaultVal = '') {

            var storageObj = this.getStorageObject();

            if (storageObj == null) {
                return defaultVal;
            }
            var data = JSON.parse(storageObj);

            return _.has(data, key) ? data[key] : defaultVal;
        },

        setStorageItem(key, value) {

            var storageObj = this.getStorageObject();

            if (storageObj == null) {
                localStorage.setItem(this.getStorageKey(), JSON.stringify({key: value}));
                return;
            }

            var data = JSON.parse(storageObj);

            if (_.has(data, key)) {
                data[key] = value;
                localStorage.setItem(this.getStorageKey(), JSON.stringify(data));
                return;
            }

            data.key = value;
            localStorage.setItem(this.getStorageKey(), JSON.stringify(data));
        },


        prev() {
            --this.form.step;
            this.setFormDataToStorageObject();
        },

        next() {
            ++this.form.step;
            this.setFormDataToStorageObject();
        },

        validateInput(scope, callback) {
            // do validation here
            this.$validator.validateAll(scope)
                .then((result) => {
                    if (result) {
                        callback();
                    }
                });
        },

        async onTourSelected(tourId, tour) {
            await this.validateInput('step1', async () => {
                await this.setSelectedTour(tourId, tour);
                await this.setTourMembers();
                await this.updateTourDiscount(tourId, this.form.tour_date);
                await this.next();
            });
        },

        async setMemberDetail() {
            await this.validateInput('step2', async () => {
                await this.next();
            });
        },

        async setTransport() {
            await this.validateInput('step3', async () => {
                await this.next();
            });
        },

        async setPersonDetail() {
            await this.validateInput('step4', async () => {
                await this.next();
            });
        },

        updateTourDiscount(tourId, tourDate) {
            return axios.post(window.booking_form.get_tour_discount_url, {
                tour_date: tourDate,
                tour_id: tourId,
            })
                .then(async function (response) {
                    if(response.status == 200) {
                        bookingForm.form.discount = response.data.data.discount;
                        bookingForm.form.discount_type = response.data.data.discount_type;
                    }
                    if(response.status == 422) {
                        alert('Validation error');
                    }
                }).catch(function (error) {
                    alert(error);
                });
        },

        getDateInReadable(date) {
            if (date == null) {
                return '';
            }

            return moment(date).format('MMMM DD, YYYY');
        },

        setSelectedTour(tourId, tour) {
            this.form.tour_id = tourId;
            this.tourSelected = tour;
        },

        setSelectedTourById(tourId) {
            if (this.tours.length > 0) {
                this.tourSelected = this.tours.find(function (tour) {
                    return tour.id == tourId;
                }, tourId);
                this.form.tour_id = tourId;
            }
        },

        setTourMembers() {
            this.form.members = this.tourSelected.pricing.map(function (pricing) {
                return {
                    type: pricing.person_type,
                    min: pricing.min_persons,
                    max: pricing.max_persons,
                    price: pricing.price,
                    size: 0,
                };
            });
        },

        onDatePickerMonthChange(date) {

        },

        async onTourDateChange(date) {
            await this.setTourDate(this.getTourDateFromDatePicker(date));
            await this.updateToursByDate();
            await this.setToursInLocalStorage();
            await this.setFormDataToStorageObject();
        },

        updateToursByDate() {
            return axios.post(window.booking_form.get_tours_by_date_url, {
                tour_date: this.form.tour_date
            })
                .then(async function (response) {
                    if(response.status == 200) {
                        await bookingForm.setTours(response.data.data);
                        await bookingForm.setToursInLocalStorage();
                    }
                    if(response.status == 422) {
                        alert('Validation error');
                    }
                }).catch(function (error) {
                alert(error);
            });
        },

        setTourDate(dateInString) {
            this.form.tour_date = dateInString;
        },

        getTourDateFromDatePicker(date) {
            if (date == null) {
                return '';
            }
            return date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
        },

        incrementMember(member) {

            if (this.hasMemberExceededTotal()) {
                alert('Member exceeded');
                return;
            }

            if (member.max > 0) {
                if (member.size < member.max) {
                    member.size++;
                }
                return;
            }
            member.size++;
        },

        decrementMember(member) {
            if (member.size > 0)
                member.size--;
        },

        hasMemberExceededTotal() {
            let total = 0;

            for (let member of this.form.members) {
                total += member.size;
            }

            return total >= this.tourSelected.left_person;
        },

        onTransportChange(transport) {
            this.form.transport_id = transport.id;
            this.form.transport_type = transport.type;
        },

        onHotelSelected() {
            if (this.form.transport.hotel_id == 0) {
                this.form.transport.hotel_id = 0;
                this.form.transport.hotel_name = '';
                this.form.transport.hotel_phone_no = '';
                return;
            }

            for (let hotel of this.hotels) {
                if (hotel.id == this.form.transport.hotel_id) {
                    this.form.transport.hotel_id = hotel.id;
                    this.form.transport.hotel_name = hotel.name;
                    this.form.transport.hotel_phone_no = hotel.phone_no;
                }
            }
        },

        showPaypalUnsuccessMessage() {
            alert('Unsuccessful Paypal');
        },

        setUpPaypalPayment() {
            // Render the PayPal button into #paypal-button-container
            paypal_sdk.Buttons({
                // Set up the transaction
                createOrder: function (data, actions) {
                    return axios.post(window.booking_form.get_paypal_create_order_url, bookingForm.form)
                        .then(function (response) {
                            return response.data.id;
                        }).catch(function (error) {
                            alert(error);
                        });
                },

                // Finalize the transaction
                onApprove: function (data, actions) {

                    var formData = bookingForm.form;
                    formData.order_id = data.orderID;
                    formData.payer_id = data.payerID;
                    formData.payment_id = data.paymentID;

                    return axios.post(window.booking_form.get_paypal_execute_order_url, formData)
                        .then(async function (response) {

                        if (response.status != 200) {
                            this.showPaypalUnsuccessMessage();
                            return;
                        }

                        if (response.data.data.transaction_id == 0) {
                            return;
                        }

                        if (response.data.data.transaction_id != 0) {
                            bookingForm.hasSeenCongrats = true;
                            bookingForm.isPaymentCompleted = true;
                            bookingForm.showPaypalPayment = false;
                            await bookingForm.clearStorageObject();
                            await bookingForm.redirectTo(window.booking_form.get_booking_detail_url+'/'+response.data.data.booking.code);
                        }

                    }).catch(function (error) {
                        console.log(error);
                    });
                }

            }).render('#paypal-button-container');
        },

        redirectTo(url) {
            return window.location.href = url;
        },

        isDiscountTypePercentage() {
            return this.form.discount_type === 'percentage';
        }

    },

    watch: {
        'form.members': {
            handler: function (members, previous) {
                let total = 0;
                for (let member of members) {
                    total += member.price * member.size;
                }
                this.form.sub_total = total;

                if (this.form.discount_type === 'percentage') {
                    this.form.discount_total = (this.form.discount * total)/100;
                }

                if (this.form.discount_type === 'fixed_amount') {
                    this.form.discount_total = this.form.discount;
                }

                if (this.form.discount_total >=  this.form.sub_total) {
                    this.form.grand_total = 0;
                    return;
                }

                this.form.grand_total = this.form.sub_total - this.form.discount_total;
            },
            deep: true
        },

    }
});

