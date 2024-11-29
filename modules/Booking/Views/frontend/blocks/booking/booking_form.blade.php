<div class="book-service1 section ">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-12 p-right">
                <h1>{!! $title !!}
                </h1>
                {!! $content !!}
                <a href="tel:00493041723130">
                <div class="row head_call" style="margin-top:20px">
                    <div class="call-icon">
                        <img src="/assests/img/icons/cta-phone-icon.svg">
                    </div>
                    <div>
                        <span>Meissner-Hotline</span>
                        <h4>030 4172 3130</h4>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-12">
                <div class="book-service-form">
                    <h2>{!! $booking_title !!}</h2>
                    <p>{!! $booking_content !!}</p>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Forms -->
                    <div class="mess_progressbar">
                        <div class="mess_progress" id="mess_progress"></div>
                        <div class="mess_progress-step mess_progress-step-active" data-title="1. Schritt"></div>
                        <div class="mess_progress-step" data-title="2. Schritt"></div>
                        <div class="mess_progress-step" data-title="3. Schritt"></div>
                    </div>

                    <form id="mess_form" method="POST" action="{{ route('booking.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <!-- Step 1 -->
                        <div class="mess_form-step mess_form-step-active">
                            <div class="mess_input-group">
                                <label for="has_preferred_date">Haben Sie bereits einen Wunschtermin? <span
                                        class="required">*</span></label>
                                <select name="has_preferred_date" id="has_preferred_date" required class="form-control">
                                    <option value="">Bitte wählen</option>
                                    <option value="Flexibel">Flexibel</option>
                                    <option value="Fixtermin">Fixtermin</option>
                                    <option value="Nein">Nein</option>
                                </select>
                            </div>
                            <div class="mess_two_col">
                                <div class="mess_input-group">
                                    <label for="preferred_date">Wunschtermin <span class="required">*</span></label>
                                    <input type="date" name="preferred_date" id="preferred_date" placeholder=""
                                        class="form-control" min="{{ date('Y-m-d') }}">
                                </div>
                                <div class="mess_input-group">
                                    <label for="preferred_time">Uhrzeit <span class="required">*</span></label>
                                    <select name="preferred_time" id="preferred_time" required class="form-control">
                                        <option value="">bitte auswählen</option>
                                        <option value="Morgens zwischen 7.00 und 10.00 Uhr">Morgens zwischen 7.00 und
                                            10.00 Uhr</option>
                                        <option value="Vormittags zwischen 10.00 und 13.00 Uhr">Vormittags zwischen
                                            10.00 und 13.00 Uhr</option>
                                        <option value="Nachmittags zwischen 13.00 und 16.00 Uhr">Nachmittags zwischen
                                            13.00 und 16.00 Uhr</option>
                                        <option value="Spätnachmittags zwischen 16.00 und 18.00 Uhr">Spätnachmittags
                                            zwischen 16.00 und 18.00 Uhr</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mess_input-group">
                                <label for="service">Was können wir für Sie tun? <span
                                        class="required">*</span></label>
                                <div class="radio-image">

                                    <label class="radio-image-item"><input type="checkbox" name="service[]"
                                            value="Wohnungsauflösung">
                                        <div class="inner_label">
                                            <figure class="rii-image"><img
                                                    src="/uploads/0000/1/2024/09/13/apartment-c.svg"
                                                    alt="Wohnungsauflösung"></figure> <span
                                                class="rii-name">Wohnungsauflösung</span>
                                        </div>
                                    </label>
                                    <label class="radio-image-item"><input type="checkbox" name="service[]"
                                            value="Entrümpelung / Entsorgung">
                                        <div class="inner_label">
                                            <figure class="rii-image"><img
                                                    src="/uploads/0000/1/2024/09/13/entsorgung-truck.svg"
                                                    alt="Entrümpelung / Entsorgung"></figure> <span
                                                class="rii-name">Entrümpelung / Entsorgung</span>
                                        </div>
                                    </label>
                                    <label class="radio-image-item"><input type="checkbox" name="service[]"
                                            value="Kellerauflösung">
                                        <div class="inner_label">
                                            <figure class="rii-image"><img
                                                    src="/uploads/0000/1/2024/09/13/kelleraufloesung-i.svg"
                                                    alt="Kellerauflösung"></figure> <span
                                                class="rii-name">Kellerauflösung</span>
                                        </div>
                                    </label>
                                    <label class="radio-image-item"><input type="checkbox" name="service[]"
                                            value="Betriebsauflösung">
                                        <div class="inner_label">
                                            <figure class="rii-image"><img
                                                    src="/uploads/0000/1/2024/09/13/betriebsaufloesung-i.svg"
                                                    alt="Betriebsauflösung"></figure> <span
                                                class="rii-name">Betriebsauflösung</span>
                                        </div>
                                    </label>
                                    <label class="radio-image-item"><input type="checkbox" name="service[]"
                                            value="Renovierung">
                                        <div class="inner_label">
                                            <figure class="rii-image"><img
                                                    src="/uploads/0000/1/2024/09/13/renovation-i5.svg"
                                                    alt="Renovierung"></figure> <span
                                                class="rii-name">Renovierung</span>
                                        </div>
                                    </label>

                                </div>
                            </div>
                            <button type="button" class="mess_btn mess_btn-next">Weiter</button>
                        </div>

                        <!-- Step 2 -->
                        <div class="mess_form-step">
                            <div class="mess_input-group">
                                <label for="order_street">Auftragsort <span class="required">*</span></label>
                                <input type="text" name="order_street" id="order_street" 
                                    placeholder="Straße und Hausnummer" class="form-control">
                            </div>
                            <div class="mess_two_col">
                                <div class="mess_input-group">
                                    <label for="order_postal_code">PLZ <span class="required">*</span></label>
                                    <input type="text" name="order_postal_code" id="order_postal_code" 
                                        placeholder="PLZ" class="form-control">
                                </div>
                                <div class="mess_input-group">
                                    <label for="order_city">Ort <span class="required">*</span></label>
                                    <input type="text" name="order_city" id="order_city" 
                                        placeholder="Ort" class="form-control">
                                </div>
                            </div>
                            <div class="mess_two_col">
                                <div class="mess_input-group">
                                    <label for="order_living_space">Wohnfläche (m²) <span
                                            class="required">*</span></label>
                                    <input type="number" name="order_living_space" id="order_living_space" 
                                        class="form-control">
                                </div>
                                <div class="mess_input-group">
                                    <label for="order_total_rooms">Anzahl der Räume <span
                                            class="required">*</span></label>
                                    <input type="number" name="order_total_rooms" id="order_total_rooms" 
                                        class="form-control">
                                </div>
                            </div>
                            <div class="mess_two_col">
                                <div class="mess_input-group">
                                    <label for="order_evacuation_site">Evakuierungsort <span
                                            class="required">*</span></label>
                                    <select name="order_evacuation_site" id="order_evacuation_site" required
                                        class="form-control">
                                        <option value="">bitte auswählen</option>
                                        <option value="komplette Betriebsauflösung">komplette Betriebsauflösung
                                        </option>
                                        <option value="Zur Hälfte der Betriebsauflösung">Zur Hälfte der
                                            Betriebsauflösung</option>
                                        <option value="Zum Teil, bis 10 Möbelstücke">Zum Teil, bis 10 Möbelstücke
                                        </option>
                                        <option value="Einige Möbel, bis 5 Möbelstücke">Einige Möbel, bis 5 Möbelstücke
                                        </option>
                                        <option value="Ein Möbelstück">Ein Möbelstück</option>
                                    </select>
                                </div>
                                <div class="mess_input-group">
                                    <label for="order_floor">Stockwerk <span class="required">*</span></label>
                                    <select name="order_floor" id="order_floor" required class="form-control">
                                        <option value="">bitte auswählen</option>
                                        <option value="1.OG">1.OG</option>
                                        <option value="2.OG">2.OG</option>
                                        <option value="3.OG">3.OG</option>
                                        <option value="4.OG">4.OG</option>
                                        <option value="5.OG">5.OG</option>
                                        <option value="6.OG">6.OG</option>
                                        <option value="7.OG">7.OG</option>
                                        <option value="8.OG">8.OG</option>
                                        <option value="9.OG">9.OG</option>
                                        <option value="10.OG">10.OG</option>
                                        <option value="11.OG">11.OG</option>
                                        <option value="12.OG">12.OG</option>
                                        <option value="13.OG">13.OG</option>
                                        <option value="14.OG">14.OG</option>
                                        <option value="15.OG">15.OG</option>
                                        <option value="16.OG">16.OG</option>
                                        <option value="17.OG">17.OG</option>
                                        <option value="18.OG">18.OG</option>
                                        <option value="19.OG">19.OG</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mess_two_col">
                                <div class="mess_input-group c_btn_radio">
                                    <label for="order_has_elevator">Fahrstuhl vorhanden? <span class="required">*</span></label>
                                    <div class="radio-form">
                                        <label><input type="radio" name="order_has_elevator" value="Ja" checked> <span class="radio-l-name">Ja</span></label>
                                        <label><input type="radio" name="order_has_elevator" value="Nein" > <span class="radio-l-name">Nein</span></label>
                                    </div>
                                </div>
                                <div class="mess_input-group c_btn_radio">
                                    <label for="order_stopping_ban">Halteverbot nötig? <span class="required">*</span></label>
                                    <div class="radio-form">
                                        <label><input type="radio" name="order_stopping_ban" value="Ja" checked> <span class="radio-l-name">Ja</span></label>
                                        <label><input type="radio" name="order_stopping_ban" value="Nein" > <span class="radio-l-name">Nein</span></label>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="mess_btn mess_btn-prev">Zurück</button>
                            <button type="button" class="mess_btn mess_btn-next">Weiter</button>
                        </div>

                        <!-- Step 3 -->
                        <div class="mess_form-step">
                            <div class="mess_two_col">
                                <div class="mess_input-group">
                                    <label for="contact_first_name">Vorname <span class="required">*</span></label>
                                    <input type="text" name="contact_first_name" id="contact_first_name" 
                                        class="form-control">
                                </div>
                                <div class="mess_input-group">
                                    <label for="contact_last_name">Nachname <span class="required">*</span></label>
                                    <input type="text" name="contact_last_name" id="contact_last_name" 
                                        class="form-control">
                                </div>
                            </div>
                            <div class="mess_input-group">
                                <label for="contact_company">Firma</label>
                                <input type="text" name="contact_company" id="contact_company"
                                    class="form-control">
                            </div>
                            <div class="mess_two_col">
                                <div class="mess_input-group">
                                    <label for="contact_telephone_no">Telefon <span class="required">*</span></label>
                                    <input type="text" name="contact_telephone_no" id="contact_telephone_no"
                                         class="form-control">
                                </div>
                                <div class="mess_input-group">
                                    <label for="contact_email">E-Mail <span class="required">*</span></label>
                                    <input type="email" name="contact_email" id="contact_email" 
                                        class="form-control">
                                </div>
                            </div>
                            <div class="mess_input-group">
                                <label for="work_detail">Details zur Arbeit</label>
                                <textarea name="work_detail" id="work_detail" class="form-control"></textarea>
                            </div>
                            <div class="mess_input-group">
                                <label for="attachment">Dateianhang</label>
                                <input type="file" name="attachment[]" multiple id="attachment" class="form-control">
                            </div>

                            {{-- <div class="mess_input-group">
                                <label for="lastName">Was können wir für Sie tun? <span class="required">*</span></label>
                                <div class="radio-image">
                                  <label class="radio-image-item"><input type="checkbox" name="extra_service[]" value="Wohnungsauflösung"><div class="inner_label"><figure class="rii-image"><img src="https://aflex.de/uploads/0000/1/2024/02/26/appartment.png" alt="Wohnungsauflösung"></figure> <span class="rii-name">Wohnungsauflösung</span></div> </label>
                                  <label class="radio-image-item"><input type="checkbox" name="extra_service[]" value="Entrümpelung / Entsorgung"><div class="inner_label"><figure class="rii-image"><img src="https://aflex.de/uploads/0000/1/2024/02/26/garbage-car.png" alt="Entrümpelung / Entsorgung"></figure> <span class="rii-name">Entrümpelung / Entsorgung</span> </div></label>
                                  <label class="radio-image-item"><input type="checkbox" name="extra_service[]" value="Kellerauflösung"><div class="inner_label"><figure class="rii-image"><img src="https://aflex.de/uploads/0000/1/2024/02/26/aflex-basement.png" alt="Kellerauflösung"></figure> <span class="rii-name">Kellerauflösung</span> </div></label>
                                  <label class="radio-image-item"><input type="checkbox" name="extra_service[]" value="Betriebsauflösung"><div class="inner_label"><figure class="rii-image"><img src="https://aflex.de/uploads/0000/1/2024/02/26/office-building.png" alt="Betriebsauflösung"></figure> <span class="rii-name">Betriebsauflösung</span> </div></label>
                                  <label class="radio-image-item"><input type="checkbox" name="extra_service[]" value="Renovierung"><div class="inner_label"><figure class="rii-image"><img src="https://aflex.de/uploads/0000/1/2024/02/26/aflex-renovation.png" alt="Renovierung"></figure> <span class="rii-name">Renovierung</span> </div></label>
                                </div>
                          </div> --}}
                            <button type="button" class="mess_btn mess_btn-prev">Zurück</button>
                            <button type="submit" class="mess_btn mess_btn-submit">Absenden</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@once
    @push('js')
    <script src="https://maps.googleapis.com/maps/api/js?language=de&region=DE&key=AIzaSyC6FL8cKJSHFIkwZzQZlbgesNpcmkyXC6Q&libraries=places&&callback=Function.prototype"></script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById('mess_form');
        const progress = document.getElementById('mess_progress');
        const steps = document.querySelectorAll('.mess_form-step');
        const stepButtons = document.querySelectorAll('.mess_btn-next, .mess_btn-prev');

        let currentStep = 0;

        function showStep(stepIndex) {
            steps.forEach((step, index) => {
                step.classList.toggle('mess_form-step-active', index === stepIndex);
            });
            updateProgressBar(stepIndex);
        }

        function updateProgressBar(stepIndex) {
            const progressWidth = (stepIndex / (steps.length - 1)) * 100;
            progress.style.width = `${progressWidth}%`;
            document.querySelectorAll('.mess_progress-step').forEach((step, index) => {
                step.classList.toggle('mess_progress-step-active', index <= stepIndex);
            });
        }

        function clearError(step) {
            const errorMessages = step.querySelectorAll('.error-message');
            errorMessages.forEach(message => message.remove());

            const invalidInputs = step.querySelectorAll('.form-control:invalid');
            invalidInputs.forEach(input => {
                input.classList.remove('error');
                const nextSibling = input.nextElementSibling;
                if (nextSibling && nextSibling.classList.contains('error-message')) {
                    nextSibling.remove();
                }
            });
        }

        function validateStep(stepIndex) {
            
            const step = steps[stepIndex];
            clearError(step);

            let isValid = true;

            const inputs = step.querySelectorAll('.form-control');
            inputs.forEach(input => {
                if (input.name === 'contact_company') {
                    return;
                }
               
                if (input.type === 'date') {
                    if (!input.value) {
                        isValid = false;
                        input.classList.add('error');
                        if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-message')) {
                            const errorMessage = document.createElement('div');
                            errorMessage.classList.add('error-message');
                            errorMessage.textContent = 'Bitte wählen Sie ein gültiges Datum aus.';
                            input.parentElement.appendChild(errorMessage);
                        }
                    }
                } else if (input.tagName === 'SELECT' && input.required && !input.value) {
                    // Handle select dropdown validation
                    isValid = false;
                    input.classList.add('error');
                    if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-message')) {
                        const errorMessage = document.createElement('div');
                        errorMessage.classList.add('error-message');
                        errorMessage.textContent = 'Bitte wählen Sie einen Eintrag aus der Liste aus.';
                        input.parentElement.appendChild(errorMessage);
                    }
                }else if (input.type == 'text' && !input.value) {
                
                    // Handle select dropdown validation
                    isValid = false;
                    input.classList.add('error');
                    if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-message')) {
                        const errorMessage = document.createElement('div');
                        errorMessage.classList.add('error-message');
                        errorMessage.textContent = 'Bitte füllen Sie dieses Feld aus.';
                        input.parentElement.appendChild(errorMessage);
                    }
                }else if (input.type == 'number' && !input.value) {
                
                    // Handle select dropdown validation
                    isValid = false;
                    input.classList.add('error');
                    if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-message')) {
                        const errorMessage = document.createElement('div');
                        errorMessage.classList.add('error-message');
                        errorMessage.textContent = 'Bitte füllen Sie dieses Feld aus.';
                        input.parentElement.appendChild(errorMessage);
                    }
                } 

                // pankaj change
                else if (input.type === 'email') {
                    if (!input.value) {
                        isValid = false;
                        input.classList.add('error');
                        if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-message')) {
                            const errorMessage = document.createElement('div');
                            errorMessage.classList.add('error-message');
                            errorMessage.textContent = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
                            input.parentElement.appendChild(errorMessage);
                        }
                    } else if (!input.checkValidity()) {
                        isValid = false;
                        input.classList.add('error');
                        if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-message')) {
                            const errorMessage = document.createElement('div');
                            errorMessage.classList.add('error-message');
                            errorMessage.textContent = 'Bitte geben Sie eine gültige E-Mail-Adresse ein.';
                            input.parentElement.appendChild(errorMessage);
                        }
                    }
                }
                
                else if (!input.checkValidity()) {
                   
                    isValid = false;
                    input.classList.add('error');
                    if (!input.nextElementSibling || !input.nextElementSibling.classList.contains('error-message')) {
                        const errorMessage = document.createElement('div');
                        errorMessage.classList.add('error-message');
                        errorMessage.textContent = input.validationMessage || 'Bitte füllen Sie dieses Feld aus.';
                        input.parentElement.appendChild(errorMessage);
                    }
                }
            });

            return isValid;
        }

        stepButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (button.classList.contains('mess_btn-next')) {
                if (validateStep(currentStep)) {
                    currentStep++;
                    if (currentStep >= steps.length) {
                        currentStep = steps.length - 1;
                    }
                    showStep(currentStep);
                }
            } else if (button.classList.contains('mess_btn-prev')) {
                currentStep--;
                if (currentStep < 0) {
                    currentStep = 0;
                }
                showStep(currentStep);
            }
        });
    });

    // Add form submit event listener
    form.addEventListener('submit', function(e) {
        if (!validateStep(currentStep)) {
            e.preventDefault(); // Prevent form submission if the last step isn't valid
        }
    });

        // stepButtons.forEach(button => {
        //     button.addEventListener('click', (e) => {
        //         const isNext = button.classList.contains('mess_btn-next');
        //         if (isNext) {
        //             if (validateStep(currentStep)) {
        //                 currentStep++;
        //                 if (currentStep >= steps.length) {
        //                     currentStep = steps.length - 1;
        //                 }
        //                 showStep(currentStep);
        //             }
        //         } else {
        //             currentStep--;
        //             if (currentStep < 0) {
        //                 currentStep = 0;
        //             }
        //             showStep(currentStep);
        //         }
        //     });
        // });

        // Show the first step initially
        showStep(currentStep);
    });

        //pankaj change
        $(document).ready(function () {
    let autocompleteStreet, autocompletePostalCode, autocompleteCity;

    function initAutocomplete() {
        // Initialize autocomplete for the street input.
        autocompleteStreet = new google.maps.places.Autocomplete(
            document.getElementById('order_street'),
            {
                componentRestrictions: { country: 'de' },  // Limit to Germany
                types: ['address'],  // Search for addresses only
                fields: ["address_components", "geometry"]
            }
        );

        // Initialize autocomplete for the postal code input.
        autocompletePostalCode = new google.maps.places.Autocomplete(
            document.getElementById('order_postal_code'),
            {
                componentRestrictions: { country: 'de' },
                types: ['address'],
                fields: ["address_components", "geometry"]
            }
        );

        // Initialize autocomplete for the city input.
        autocompleteCity = new google.maps.places.Autocomplete(
            document.getElementById('order_city'),
            {
                componentRestrictions: { country: 'de' },
                types: ['address'],  // Search for cities
                fields: ["address_components", "geometry"]
            }
        );

        // Add event listener for street input field.
        autocompleteStreet.addListener('place_changed', function () {
            const place = autocompleteStreet.getPlace();
            fillAddressFields(place);
        });

        // Add event listener for postal code input field.
        autocompletePostalCode.addListener('place_changed', function () {
            const place = autocompletePostalCode.getPlace();
            fillAddressFields(place);
        });

        // Add event listener for city input field.
        autocompleteCity.addListener('place_changed', function () {
            const place = autocompleteCity.getPlace();
            fillAddressFields(place);
        });
    }

    // Function to fill in the address components
    function fillAddressFields(place) {
        let street = '', streetNumber = '', postalCode = '', city = '';

        // Extract address components from the selected place.
        if (place.address_components) {
            place.address_components.forEach(function (component) {
                const componentType = component.types[0];

                switch (componentType) {
                    case 'route':
                        street = component.long_name;  // Street name
                        break;
                    case 'street_number':
                        streetNumber = component.long_name;  // Street number
                        break;
                    case 'postal_code':
                        postalCode = component.long_name;  // Postal code
                        break;
                    case 'locality':
                        city = component.long_name;  // City name
                        break;
                }
            });

            // Populate the form fields with the extracted values.
            const fullStreetAddress = street + ' ' + streetNumber;
            if (fullStreetAddress) {
                $('#order_street').val(fullStreetAddress);
            }
            if (postalCode) {
                $('#order_postal_code').val(postalCode);
            }
            if (city) {
                $('#order_city').val(city);
            }
        }
    }

    // Initialize the autocomplete for all three fields
    initAutocomplete();
});
    </script>
    @endpush
@endonce

