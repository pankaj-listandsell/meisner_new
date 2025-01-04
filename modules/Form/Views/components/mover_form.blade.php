<div id="form_manager" class="form-manager-container">
    <form_manager
            :schema="{{ json_encode(\App\Libraries\FormSchema\Form\MoverForm::schema()) }}"
            :config="{{ json_encode([
                        'lang' => get_current_lang(),
                        'registerFormUrl' => route('frontend.register.mover_form'),
                        'getTermText' => trans('I have read and agree to the terms of use and :link'),
                        'honeypot' => $honeypot
                    ]) }}"
    ></form_manager>
</div>

@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?language=de&region=DE&key=AIzaSyC6FL8cKJSHFIkwZzQZlbgesNpcmkyXC6Q&libraries=places&&callback=Function.prototype"></script>
    <script src="{{ asset('dist/frontend/js/mover_form.js') }}"></script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ asset('dist/frontend/css/form.css') }}"/>
    <script>
        window.Laravel = <?php echo json_encode(VueLaravelLocaleArrayData()); ?>
    </script>
@endpush
