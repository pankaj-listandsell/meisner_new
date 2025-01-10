{{-- <div id="notification-container"></div> --}}
<div class="form-container">
    <!-- Visual Step Progress Bar -->
    <div class="progress-bar">
        <div class="progress-step active">
            <div class="step-circle">✔</div>
            <p>Das Objekt</p>
        </div>
        <div class="progress-step">
            <div class="step-circle">✔</div>
            <p>Die Gegenstände</p>
        </div>
        <div class="progress-step">
            <div class="step-circle">-</div>
            <p>Die Buchung</p>
        </div>
        <!-- Progress Line with Inner Active Line -->
        <div class="progress-line">
            <div class="progress-line-fill"></div>
        </div>
    </div>
    @php
        $category = \Modules\Products\Models\ProductsCategory::get();
    @endphp
    <div class="multi-main-form">
        @if (session('success'))
        <div style="
            background-color: #d4edda; 
            color: #155724; 
            border: 1px solid #c3e6cb; 
            padding: 15px; 
            border-radius: 5px; 
            margin-bottom: 20px; 
            font-size: 16px;">
            {{ session('success') }}
        </div>
        @endif
        <div class="form-step active">
            <h2>Bitte beantworte uns einige kurze Fragen für deinen individuellen Festpreis</h2>

            <div class="form-inner">
                <div class="form-box form-one">
                    <label>Adresse <span style="color:red">*</span></label>
                    <div class="search-container">
                        <input type="text" id="address" placeholder="Suche..">
                    </div>
                    <span class="s1 text-danger steofirst_error" id="address_error"
                        style="color:#d63637;font-size: 13px; display:none">Bitte Adresse hinzufügen</span>
                </div>
                <div class="form-box">
                    <label>Stadt <span style="color:red">*</span></label>
                    <input type="text" id="city" placeholder="" class="form-control pac-target-input"
                        autocomplete="off">
                    <span class="s1 text-danger steofirst_error" id="city_error"
                        style="color:#d63637;font-size: 13px; display:none">Bitte Stadt hinzufügen</span>
                </div>
                <div class="form-box">
                    <label>Postleitzahl <span style="color:red">*</span></label>
                    <input type="text" id="zipcode" placeholder="" maxlength="5" class="form-control pac-target-input"
                        autocomplete="off">
                    <span class="s1 text-danger steofirst_error" id="zipcode_error" style="color:#d63637;font-size: 13px; display:none">Bitte Postleitzahl angeben</span>
                </div>
                <div class="form-box">
                    <label>wähle Dein Stockwerk <span style="color:red">*</span></label>
                    <select id="building">
                        <option value="Erdgeschoss">Erdgeschoss</option>
                        <option value="Keller">Keller</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="10+">10+</option>
                    </select>
                </div>
                <div class="form-box">
                    <label>Aufzug<span style="color:red">*</span></label>
                    <select id="flour">
                        <option value="">Gibt es einen Fahrstuhl?</option>
                        <option value="Ja">Ja</option>
                        <option value="Nein">Nein</option>
                    </select>
                    <span class="s1 text-danger steofirst_error" id="flour_error" style="color:#d63637;font-size: 13px; display:none">Bitte wählen Sie einen Aufzug</span>
                </div>

            </div>
            <div class="step-next-btn">
                <button type="button" onclick="addAddress()" class="next-btn">Weiter</button>
            </div>
        </div>

        <!-- Step 2: Contact Info -->
        <div class="form-step" id="form_step_item">
            <div class="container">
                <h2>Welche Gegenstände sollen weg?</h2>
                {{-- Search Category --}}
                <input type="hidden" id="searchType" value="1">
                <input type="hidden" id="searchItem" value="">
                <div class="serach-clear">
                    <div class="search-box">
                        <input type="text" id="search_category" placeholder="Suche..">
                        <button type="button" class="searchcategory"
                            onclick="search_category()"><span><img src="/uploads/0000/1/2024/12/26/search-interface-symbol.png"></span></button>

                    </div>
                    <button type="button" style="display: none" class="clearcategory" onclick="clear_category()"><span><img src="/uploads/0000/1/2024/12/26/close.png"></span></button>
                </div>
                <div class="help-text">
                    <p>Nicht sicher bei der Auswahl? Rufe kostenlos unsere Kundenberater an <a
                            href="tel:03041723130">030 4172 3130</a></p>
                </div>
            </div>
            <div class="category-box-main search_category_result">
                @foreach ($category as $catVal)
                                <?php
                    $image_url = get_file_url($catVal->image_id, 'full');
                    $image_details = get_file_details($catVal->image_id, '#');
                                    ?>
                                <div class="category-box" onclick="category_products({{ $catVal->id }})">
                                    <img src="{{$image_url != '' ? $image_url : url('uploads/0000/1/2024/12/26/thumbmail.png')  }}"
                                        title="{{ isset($image_details['title']) ? $image_details['title'] : '#' }}"
                                        alt="{{ isset($image_details['alt']) ? $image_details['alt'] : '#' }}">
                                    <p>{{ $catVal->name }}</p>
                                </div>
                @endforeach
            </div>
            <div class="disposal-category-items" style="display: none;">
                <div class="image-box-main" id="categoryItemsView">
                </div>
            </div>

            <div class="step-next-btn">
                <button type="button" class="prev-btn">Vorherige</button>
                <div class="pr_next">
                    <div class="cart_price"><span class="main_total">0 €</span> <img src="/uploads/0000/1/2024/12/26/grocery-store.png"></div>
                    <button type="button" onclick="goCart()" class="next-btn">Weiter</button>
                </div>
            </div>
        </div>
        <!-- Step 3: Social Links -->
        <div class="form-step">
            <h2>Wähle deinen Wunschtermin</h2>
            <form id="add_to_cart_form">

                <div class="step-three-main">
                    <div class="step-left">
                        <h2>Wunschtermin und Zeitraum auswählen</h2>
                        <div class="name_row">
                        <div class="form-box-three box-one">
                            <select name="gender" id="gender">
                                <option value="">Anrede</option>
                                <option value="Herr">Herr</option>
                                <option value="Frau">Frau</option>
                            </select>
                            </div>
                        <div class="form-box-three box-one">
                            <input type="firstname" id="fname" name="fname" placeholder="Vorname  *">
                        </div>
                        <div class="form-box-three box-one">
                            <input type="text" class="form-control pac-target-input" id="lname" name="lname" autocomplete="off" placeholder="Nachname ">
                        </div>
                        </div>
                        <span class="s1 text-danger error_msg" id="fname_error"style="color:#d63637;font-size: 13px; display:none">Bitte geben Sie Ihren Namen ein</span>
                        <div class="form-box-three">
                            <input type="email" class="form-control pac-target-input" id="email" name="email"
                                autocomplete="off" placeholder="E-Mail *">
                            <span class="s1 text-danger error_msg" id="email_error"
                                style="color:#d63637;font-size: 13px; display:none">Bitte geben Sie Ihre E-Mail
                                ein</span>
                            <span class="s1 text-danger error_msg" id="email_valid_error"
                                style="color:#d63637;font-size: 13px; display:none">bitte gültige E-Mail eingeben</span>
                        </div>
                        <div class="form-box-three">
                            <input type="number" id="telephone" name="telephone"Telefon placeholder="Telefon" maxlength="15">
                        </div>
                        <div class="form-box-three">
                            <input type="company" id="company_name" name="company_name" placeholder="Name des Unternehmens">
                        </div>
                        <div class="form-box-three">
                            <input type="text" id="vat_id" name="vat_id" placeholder="USt-ID">
                        </div>
                        <div class="form-box-three date-edit">
                            <label for="Date">Buchungsdatum</label>
                            <input type="date" id="date" name="date">
                            <span class="s1 text-danger error_msg" id="date_error"
                                style="color:#d63637;font-size: 13px; display:none">Bitte wählen Sie das
                                Buchungsdatum</span>
                        </div>
                        <div class="form-box-three">
                            <select name="time" id="time">
                                <option value="">Wunschzeit auswählen..</option>
                                <option value="Morgens (06:00 - 12:00)">Morgens (06:00 - 12:00)</option>
                                <option value="Mittags (12:00 - 16:00)">Mittags (12:00 - 16:00)</option>
                                <option value="Abends (16:00 - 20:00)">Abends (16:00 - 20:00)</option>
                                <option value="Flexibel (06:00 - 20:00)">Flexibel (06:00 - 20:00)</option>
                            </select>
                            <span class="s1 text-danger error_msg" id="time_error"
                                style="color:#d63637;font-size: 13px; display:none">Bitte wählen Sie die gewünschte
                                Zeit</span>
                        </div>
                        <textarea id="note" name="note" rows="4" cols="50" placeholder="Anmerkungen:"></textarea>
                    </div>
                    <div class="step-right">
                        <div class="booking-summary">
                            <h2>Buchungsübersicht</h2>

                            <div class="section">
                                <p class="section-title"><b>Gebiet: </b><span id="address_view"></span></p>
                            </div>

                            <div class="section product_detail">
                                <p class="section-title"><b>Gegenstände</b></p>
                                <div id="cart_section_view"></div>
                            </div>

                            <div class="summary">
                                <div class="line-item">
                                    <span>Gesamtstückzahl:</span>
                                    <span id="total_pieces"></span>
                                </div>
                                <div class="line-item">
                                    <span>Nettobetrag:</span>
                                    <span id="net_amount"> €</span>
                                </div>
                                <div class="line-item">
                                    <span>MwSt.: ({{setting_item_with_lang('vat', 'de')}} %)</span>
                                    <span id="vat"> €</span>
                                </div>
                                <div class="line-item">
                                    <span>Zusatzkosten inkl. MwSt.<br>(Mindestbestellung: 199,00 €)</span>
                                    <span id="additional_cost">+ €</span>
                                </div>
                                <div class="line-item total">
                                    <span>Bruttogesamtbetrag</span>
                                    <span id="gross_total_amount">199,00 €</span>
                                </div>
                            </div>

                            <div class="note min_order_content" style="display: none">
                                Du hast den Mindestbestellwert von {{priceConvert(setting_item_with_lang('max_order_amount', 'de'))}} € noch nicht erreicht.<br>
                                Füge weitere Gegenstände hinzu.
                            </div>

                            <div class="link prev-btn min_order_content" style="display: none">weitere Gegenstände
                                auswählen</div>
                        </div>
                    </div>
                </div>
                <div class="step-next-btn">
                    <button type="button" class="prev-btn">Vorherige</button>
                    <button class="submit-btn submitbooking" id="submitbooking" type="button">Einreichen</button>
                </div>
            </form>
        </div>
    </div>
</div>


@once
    @push('js')
        <script
            src="https://maps.googleapis.com/maps/api/js?language=de&region=DE&key=AIzaSyC6FL8cKJSHFIkwZzQZlbgesNpcmkyXC6Q&libraries=places&&callback=Function.prototype"></script>
        <script type="text/javascript" src="/ls-template/assets/js/form.js" async></script>
        <script type="text/javascript">
            const progressSteps = document.querySelectorAll('.progress-step');
            const progressLineFill = document.querySelector('.progress-line-fill');
            const formSteps = document.querySelectorAll('.form-step');
            let currentStep = 0;

            document.querySelectorAll('.next-btn').forEach(button => {
                button.addEventListener('click', () => {
                    if (currentStep < formSteps.length - 1) {
                        if ($('#address').val().trim() != '' && $('#zipcode').val().trim() != '' && $('#city').val().trim() != '' && $('#flour').val().trim() != '') {
                            currentStep++;
                            updateFormSteps();
                            updateProgressBar();
                        }
                    }
                });
            });

            document.querySelectorAll('.prev-btn').forEach(button => {
                button.addEventListener('click', () => {
                    if (currentStep > 0) {
                        currentStep--;
                        updateFormSteps();
                        updateProgressBar();
                    }
                });
            });

            function updateFormSteps() {
                formSteps.forEach((step, index) => {
                    step.classList.toggle('active', index === currentStep);
                });
            }

            function updateProgressBar() {
                progressSteps.forEach((step, index) => {
                    step.classList.toggle('active', index <= currentStep);
                });

                // Update the active line's width based on current step
                const activeWidth = (currentStep / (progressSteps.length - 1)) * 100;
                progressLineFill.style.width = `${activeWidth}%`;
            }

            updateProgressBar(); // Initialize on load

            document.getElementById('search_category').addEventListener('keydown', function (event) {
                if (event.key === 'Enter') {
                    search_category();
                }
            });

            document.querySelector('.search_category_result').addEventListener('click', function (event) {
                // Check if the clicked element is a category-box
                if (event.target.closest('.category-box')) {
                    const clickedBox = event.target.closest('.category-box');
                    console.log('Category box clicked:', clickedBox);

                    // Hide all category boxes except the clicked one
                    document.querySelectorAll('.category-box').forEach(box => {
                        box.style.display = 'none';
                        box.classList.remove('selected'); // Remove 'selected' class from all boxes
                    });

                    // Show the clicked box and add 'selected' class
                    clickedBox.style.display = 'block';
                    clickedBox.classList.add('selected');

                    // Add close button if it doesn't already exist
                    if (!clickedBox.querySelector('.close-btn')) {
                        const closeButton = document.createElement('span');
                        closeButton.classList.add('close-btn');
                        closeButton.innerHTML = '✖';
                        clickedBox.appendChild(closeButton);
                    }
                }

                // Check if the clicked element is a close button
                if (event.target.classList.contains('close-btn')) {
                    console.log('Close button clicked:', event.target);
                    event.stopPropagation(); // Prevent triggering the box click again
                    // Show all category boxes again
                    document.querySelectorAll('.category-box').forEach(box => {
                        box.style.display = 'block';
                        box.classList.remove('selected');
                    });
                    // Hide disposal-category-items
                    const disposalItems = document.querySelector('.disposal-category-items');
                    if (disposalItems) {
                        $('#searchType').val(1);
                        disposalItems.style.display = 'none';
                    }
                    // Remove the close button
                    event.target.remove();
                }
            });
            // document.body.addEventListener('click', (event) => {
            //     if (event.target.matches('.increment, .decrement')) {
            //         const container = event.target.closest('.counter-container');
            //         const input = container.querySelector('.count-input');

            //         // Increment action
            //         if (event.target.matches('.increment')) {
            //             event.preventDefault(); // Prevent default action
            //             input.value = parseInt(input.value) + 1;
            //         }
            //         // Decrement action
            //         if (event.target.matches('.decrement')) {
            //             event.preventDefault(); // Prevent default action
            //             if (parseInt(input.value) - 1 > 0) {
            //                 input.value = parseInt(input.value) - 1;
            //             }
            //         }
            //     }
            // });

            function increment(id){
                let qty = $('.qty-'+id).val();
                $('.qty-'+id).val(parseInt(qty)+parseInt(1));
            }

            function decrement(id){
                let qty = $('.qty-'+id).val();
                if(qty == 1){
                    return false;
                }
                $('.qty-'+id).val(parseInt(qty)-parseInt(1));
            }

            function addAddress() {
                $('.steofirst_error').hide();
                var error = true;
                if ($('#address').val().trim() == '') {
                    $('#address_error').show();
                    error = false;
                }
                if ($('#city').val().trim() == '') {
                    $('#city_error').show();
                    error = false;
                }
                if ($('#zipcode').val().trim() == '') {
                    $('#zipcode_error').show();
                    error = false;
                }

                if ($('#flour').val().trim() == '') {
                    $('#flour_error').show();
                    error = false;
                }

                if (error == false) {
                    $('.prev-btn').click();
                    return false;
                }
                localStorage.setItem('address_cart', $("#address").val());
                localStorage.setItem('building_cart', $("#building").val());
                localStorage.setItem('flour_cart', $("#flour").val());
                localStorage.setItem('city_cart', $("#city").val());
                localStorage.setItem('zipcode_cart', $("#zipcode").val());
                // $("#address_cart").val($("#address").val());
                // $("#building_cart").val($("#building").val());
                // $("#flour_cart").val($("#flour").val());
                // $("#city_cart").val($("#city").val());
                // $("#zipcode_cart").val($("#zipcode").val());
            }

            function category_products(id) {
                $('#categoryItemsView').html('');
                document.querySelector('.disposal-category-items').style.display = 'block';

                $('#searchType').val(2);
                $('#searchItem').val(id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('bookingproduct.category_products') }}",
                    data: {
                        id: id,
                    },
                    method: 'get',
                    // beforeSend: function() {
                    //     $("#preload").show();
                    // },
                    success: function (response) {
                        if (response.status == 1) {
                            $('#categoryItemsView').html(response.data);
                        }
                    },
                    error: function (e) {
                        toastr.error("Etwas ist schief gelaufen!");
                        return false;
                    }
                });
            }

            function addtocart(id, price) {
                let qty = $('.qty-' + id).val();
                let val = id + ',' + qty + ',' + price;
                if (qty == 0) {
                    toastr.error("Menge mindestens 1 erlaubt!");
                    return false;
                }
                let form = document.getElementById('add_to_cart_form');
                let existingInput = form.querySelector(`input[data-id="${id}"]`);

                if (existingInput) {
                    let existingValue = existingInput.value.split(',');
                    let existingQty = parseFloat(existingValue[1]);
                    let existingPrice = parseFloat(existingValue[2]);
                    // main_total -= (existingQty * existingPrice);
                    form.removeChild(existingInput);
                }
                let idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.setAttribute('data-id', id);
                idInput.classList.add('added_cart', 'product_id_' + id);
                idInput.name = 'cart_item[]';
                idInput.value = val;
            
                form.appendChild(idInput);
                //Summary
                let main_total = 0;
                $('input[name="cart_item[]"]').each(function() {
                    let parts = $(this).val().split(','); 
                    main_total +=  parts[1] * parts[2];
                });
                if(main_total > 0){
                   $('.main_total').html(priceConvert(main_total) + ' €');
                }
                toastr.success("Erfolg");
            }

            function goCart() {
                let form = document.getElementById('add_to_cart_form');
                let elementWithDataId = form.querySelector('[data-id]');
                if (!elementWithDataId) {
                    $('.prev-btn').click();
                    toastr.error("Bitte Produkt auswählen!");
                    return false;
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('bookingproduct.cartdata') }}",
                    data: $('#add_to_cart_form').serialize(),
                    method: 'post',
                    // beforeSend: function() {
                    //     $("#preload").show();
                    // },
                    success: function (response) {
                        if (response.status == 1) {
                            $('.min_order_content').hide();
                            if (response.summary.gross_total_amount < response.summary.max_order_amount) {
                                $('.min_order_content').show();
                            }
                            $('#address_view').html($('#address').val() + ', ' +$('#zipcode').val() +' '+ $('#city').val());
                            $('#cart_section_view').html(response.data);
                            $('#total_pieces').html(response.summary.total_pieces);
                            $('#net_amount').html(priceConvert(response.summary.net_amount) + ' €');
                            $('#vat').html(priceConvert(response.summary.vatTaxAmount) + ' €');
                            $('#additional_cost').html(priceConvert(response.summary.additional_cost) + ' €');
                            $('#gross_total_amount').html(priceConvert(response.summary.gross_total_amount) + ' €');

                            localStorage.setItem('total_pieces_cart', response.summary.total_pieces);
                            localStorage.setItem('net_amount_cart', response.summary.net_amount);
                            localStorage.setItem('vat_cart_amount', response.summary.vatTaxAmount);
                            localStorage.setItem('vat_cart', response.summary.vat);
                            localStorage.setItem('additional_cost_cart', response.summary.additional_cost);
                            localStorage.setItem('grand_amount_cart', response.summary.gross_total_amount);
                            localStorage.setItem('max_order_amount', response.summary.max_order_amount);
                        }
                    },
                    error: function (e) {
                        toastr.error("Etwas ist schief gelaufen!");
                        return false;
                    }
                });

            }

            function priceConvert(price) {
                let formattedPrice = new Intl.NumberFormat('de-DE', {
                    style: 'decimal',
                    minimumFractionDigits: 2
                }).format(price);
                return formattedPrice;
            }

            $(document).ready(function () {
                $(".submitbooking").on("click", function () {
                    if (localStorage.getItem('grand_amount_cart') < localStorage.getItem('max_order_amount')) {
                        toastr.error('Sie können mindestens '+localStorage.getItem('max_order_amount')+'€ bezahlen, Bitte fügen Sie weitere Artikel hinzu');
                        return false;
                    }

                    $('.error_msg').hide();
                    var errorM = true;
                    if ($('#fname').val() == '') {
                        $('#fname_error').show();
                        errorM = false;
                    }
                    if ($('#email').val() == '') {
                        $('#email_error').show();
                        errorM = false;
                    }
                    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    var from_email = $("#email").val();
                    if (from_email != '') {
                        if (!emailRegex.test(from_email)) {
                            $('#email_valid_error').show();
                            errorM = false;
                            return false;
                        }
                    }
                    if ($('#date').val() == '') {
                        $('#date_error').show();
                        errorM = false;
                    }
                    if ($('#time').val() == '') {
                        $('#time_error').show();
                        errorM = false;
                    }
                    if (errorM == false) {
                        return false;
                    }
                    var address_cart = localStorage.getItem('address_cart');
                    var building_cart = localStorage.getItem('building_cart');
                    var flour_cart = localStorage.getItem('flour_cart');
                    var city_cart = localStorage.getItem('city_cart');
                    var zipcode_cart = localStorage.getItem('zipcode_cart');

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('bookingproduct.booking') }}",
                        data: $('#add_to_cart_form').serialize() + '&total_pieces_cart='+localStorage.getItem('total_pieces_cart')+'&net_amount_cart='+localStorage.getItem('net_amount_cart')+'&vat_cart_amount='+localStorage.getItem('vat_cart_amount')+'&additional_cost_cart='+localStorage.getItem('additional_cost_cart')+'&grand_amount_cart='+ localStorage.getItem('grand_amount_cart') + '&address='+address_cart+'&building='+building_cart+'&flour='+flour_cart+'&city='+city_cart+'&zipcode='+zipcode_cart,
                        method: 'post',
                        beforeSend: function () {
                            $('#submitbooking').html('Einreichen<span>...</span>');
                            $('#submitbooking').removeClass('submitbooking');
                        },
                        success: function (response) {
                            $('#submitbooking').addClass('submitbooking');
                            $('#submitbooking').html('Einreichen');
                            if (response.status == 1) {
                                localStorage.clear();
                                $("#add_to_cart_form")[0].reset();
                                toastr.success(response.message);
                                setTimeout(() => {
                                    location.reload();
                                }, 5000);
                            }
                            if (response.status == 0) {
                                toastr.error(response.message);
                            }
                        },
                        error: function (e) {
                            $('#submitbooking').addClass('submitbooking');
                            $('#submitbooking').html('Einreichen');
                            toastr.error('Etwas ist schief gelaufen!');
                            return false;
                        }
                    });
                });
            });
            function clear_category() {
                if ($('#search_category').val().trim() != '') {
                    $('#search_category').val('');
                    search_category();
                }
                $('.clearcategory').hide();

            }
            function search_category() {
                $('.clearcategory').show();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('bookingproduct.search_category') }}",
                    data: {
                        key: $('#search_category').val(),
                        type: $('#searchType').val(),
                        category: $('#searchItem').val(),
                    },
                    method: 'get',
                    // beforeSend: function() {
                    //     $('#submitbooking').removeClass('submitbooking');
                    // },
                    success: function (response) {
                        if (response.type == 1) {
                            $('.close-btn').click();
                        }

                        if (response.status == 1 && response.type == 1) {
                            $('.search_category_result').html(response.data);
                        }
                        if (response.status == 1 && response.type == 2) {
                            $('#categoryItemsView').html(response.data);
                        }
                        if (response.status == 0) {
                            if (response.type == 1) {
                                $('.search_category_result').html('<p>Keine Daten gefunden</p>');
                            }
                            if (response.type == 2) {
                                $('#categoryItemsView').html('<p>Kein Produkt gefunden!</p>');
                            }
                        }
                    },
                    error: function (e) {
                        $('#submitbooking').addClass('submitbooking');
                        toastr.error('Etwas ist schief gelaufen!');
                        return false;
                    }
                });
            }

            function increment_cart(id, price) {
                let qty = parseInt($('#counter_' + id).val()) + 1;
                updateSummary(id, price, qty, '+');
            }

            function decrement_cart(id, price) {
                let qty = parseInt($('#counter_' + id).val()) - 1;
                updateSummary(id, price, qty, '-');
            }

            function updateSummary(id, price, qty, calc) {
                if (qty == 0) {
                    return false;
                }
                let val = id + ',' + qty + ',' + price;
                let form = document.getElementById('add_to_cart_form');
                let existingInput = form.querySelector(`input[data-id="${id}"]`);

                if (existingInput) {
                    form.removeChild(existingInput);
                }
                let idInput = document.createElement('input');
                idInput.type = 'hidden';
                idInput.setAttribute('data-id', id);
                idInput.classList.add('added_cart', 'product_id_' + id);
                idInput.name = 'cart_item[]';
                idInput.value = val;
                form.appendChild(idInput);
                $('#counter_' + id).val(qty);
                //Summary
                $('#cart_prod_prive_show_' + id).html(priceConvert(qty * price) + ' €');
                let cart_total_amount = $('#cart_total_amount').val();
                if (calc == '+') {
                    var calculate_total = parseFloat(cart_total_amount) + parseFloat(price);
                    $('#cart_total_amount').val(calculate_total)
                } else {
                    var calculate_total = parseFloat(cart_total_amount) - parseFloat(price);
                    $('#cart_total_amount').val(calculate_total)
                }

                let vatTaxAmount = (calculate_total * localStorage.getItem('vat_cart')) / 100;
                // alert(vatTaxAmount);
                $('#net_amount').html(priceConvert(calculate_total) + ' €');
                $('#gross_total_amount').html(priceConvert(calculate_total) + ' €');
                $('#vat').html(priceConvert(Math.floor(vatTaxAmount * 100) / 100) + ' €');
                
                if(calculate_total > 0){
                   $('.main_total').html(priceConvert(calculate_total) + ' €');
                }

                if ($('input[prod-id="'+id+'"]').length > 0) {
                    $('input[prod-id="'+id+'"]').val(qty);
                }

                localStorage.setItem('vat_cart_amount', vatTaxAmount);
                localStorage.setItem('net_amount_cart', calculate_total);
                localStorage.setItem('grand_amount_cart', calculate_total);
                // $('#net_amount_cart').val(calculate_total);
                // $('#grand_amount_cart').val(calculate_total);
                $('.min_order_content').hide();
                if (calculate_total < localStorage.getItem('max_order_amount')) {
                    $('.min_order_content').show();
                }
            }

            $(document).ready(function () {
                let autocompleteStreet;

                function initAutocomplete() {
                    autocompleteStreet = new google.maps.places.Autocomplete(
                        document.getElementById('address'), {
                        componentRestrictions: { country: 'de' }, // Restrict to Germany
                        types: ['address'], // Address types only
                        fields: ["address_components", "geometry"] // Retrieve necessary fields
                    }
                    );

                    autocompleteCity = new google.maps.places.Autocomplete(
                        document.getElementById('city'), {
                        componentRestrictions: { country: 'de' }, // Restrict to Germany
                        types: ['address'], // Address types only
                        fields: ["address_components", "geometry"] // Retrieve necessary fields
                    }
                    );

                    autocompleteZipcode = new google.maps.places.Autocomplete(
                        document.getElementById('zipcode'), {
                        componentRestrictions: { country: 'de' }, // Restrict to Germany
                        types: ['address'], // Address types only
                        fields: ["address_components", "geometry"] // Retrieve necessary fields
                    }
                    );

                    // Add a listener for when a place is selected
                    autocompleteStreet.addListener('place_changed', function () {
                        const place = autocompleteStreet.getPlace();
                        fillAddressFields(place);
                    });
                    autocompleteCity.addListener('place_changed', function () {
                        const place = autocompleteCity.getPlace();
                        fillAddressFields(place);
                    });
                    autocompleteZipcode.addListener('place_changed', function () {
                        const place = autocompleteZipcode.getPlace();
                        fillAddressFields(place);
                    });
                }

                function fillAddressFields(place) {
                    let address = '', postalCode = '', city = ''; streetNumber = '';

                    // Extract address components
                    if (place.address_components) {
                        place.address_components.forEach(function (component) {
                            const componentType = component.types[0];
                             console.log()
                            switch (componentType) {
                                case 'route': // Alternative city representation
                                    address = component.long_name;
                                    break;
                                    case 'street_number':
                                    streetNumber = component.long_name;  // Street number
                                    break;
                                case 'postal_code':
                                    postalCode = component.long_name; // Get postal code
                                    break;
                                case 'locality': // City
                                case 'postal_town': // Alternative city representation
                                    city = component.long_name;
                                    break;
                            }
                        });

                        // Populate the form fields with the extracted values
                        const fullStreetAddress = address + ' ' + streetNumber;
                        if (fullStreetAddress) {
                            $('#address').val(fullStreetAddress);
                        }
                        if (postalCode) {
                            $('#zipcode').val(postalCode);
                        }
                        if (city) {
                            $('#city').val(city);
                        }
                    }
                }

                initAutocomplete();
            });
            const today = new Date().toISOString().split("T")[0]; // Get today's date in YYYY-MM-DD format
            document.getElementById("date").setAttribute("min", today);

            document.addEventListener('click', function (event) {
                // Check if the clicked element has the "remove" class
                if (event.target.closest('.remove')) {
                    // Get the parent element with the "remove" class
                    const removeElement = event.target.closest('.remove');


                    const itemId = removeElement.getAttribute('data-id');

                    let form = document.getElementById('add_to_cart_form');
                    let existingInput = form.querySelector(`input[data-id="${itemId}"]`);

                    if (existingInput) {
                        form.removeChild(existingInput);
                    }

                    $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('bookingproduct.cartdata') }}",
                    data: $('#add_to_cart_form').serialize(),
                    method: 'post',
                    // beforeSend: function() {
                    //     $("#preload").show();
                    // },
                    success: function (response) {
                        if (response.status == 1) {
                            $('.min_order_content').hide();
                            if (response.summary.gross_total_amount < response.summary.max_order_amount) {
                                $('.min_order_content').show();
                            }
                            $('#address_view').html($('#address').val() + ', ' +$('#zipcode').val() +' '+ $('#city').val());
                            $('#cart_section_view').html(response.data);
                            $('#total_pieces').html(response.summary.total_pieces);
                            $('#net_amount').html(priceConvert(response.summary.net_amount) + ' €');
                            $('#vat').html(priceConvert(response.summary.vatTaxAmount) + ' €');
                            $('#additional_cost').html(priceConvert(response.summary.additional_cost) + ' €');
                            $('#gross_total_amount').html(priceConvert(response.summary.gross_total_amount) + ' €');
                            if(response.summary.gross_total_amount > 0){
                                $('.main_total').html(priceConvert(response.summary.gross_total_amount) + ' €');
                            }

                            localStorage.setItem('total_pieces_cart', response.summary.total_pieces);
                            localStorage.setItem('net_amount_cart', response.summary.net_amount);
                            localStorage.setItem('vat_cart_amount', response.summary.vatTaxAmount);
                            localStorage.setItem('vat_cart', response.summary.vat);
                            localStorage.setItem('additional_cost_cart', response.summary.additional_cost);
                            localStorage.setItem('grand_amount_cart', response.summary.gross_total_amount);
                            localStorage.setItem('max_order_amount', response.summary.max_order_amount);
                        }
                    },
                    error: function (e) {
                        location.reload();
                        toastr.error("Etwas ist schief gelaufen!");
                        return false;
                    }
                });
                }
            });
        </script>
    @endpush
@endonce
