<div id="form_manager" class="form-manager-container">
    <form_manager
            :schema="{{ json_encode(\App\Libraries\FormSchema\Form\ClearingForm::schema()) }}"
            :config="{{ json_encode([
                        'lang' => get_current_lang(),
                        'registerFormUrl' => route('frontend.register.clearing_form'),
                        'getTermText' => trans('I have read and agree to the terms of use and :link'),
                        'honeypot' => $honeypot
                    ]) }}"
    ></form_manager>
</div>


@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?language=de&region=DE&key=AIzaSyCMcF9zUNz2y9XBSE0jWDQgrgk42uZ1WaE&libraries=places&&callback=Function.prototype"></script>
    <script src="{{ asset('dist/frontend/js/clearing_out_form.js') }}"></script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('dist/frontend/css/form.css') }}"/>
    <script>
        window.Laravel = <?php echo json_encode(VueLaravelLocaleArrayData()); ?>
    </script>
@endpush

