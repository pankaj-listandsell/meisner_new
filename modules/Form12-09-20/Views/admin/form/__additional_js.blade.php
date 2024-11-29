@push('js')

    <?php
    $start_date = '';
    $end_date = null;
    if (!empty($booking_dates = request()->get('form_dates'))) {
        if (str_contains($booking_dates, '/')) {
            $modified_dates = array_map('trim', explode("/",$booking_dates));
            $start_date = $modified_dates[0];
            $end_date = $modified_dates[1];
        }
    }
    ?>

    <script>
        jQuery(document).ready(function ($) {
            $('.has-daterangepicker').daterangepicker({
                startDate: '{{ isValidDate($start_date) ? $start_date : date('Y-m-d') }}',
                endDate: '{{ isValidDate($end_date) ? $end_date : null }}',
                singleDatePicker: false,
                timePicker: false,
                showDropdowns: true,
                autoUpdateInput: false,
                sameDate: true,
                autoApply           : true,
                disabledPast        : true,
                enableLoading       : true,
                showEventTooltip    : true,
                classNotAvailable   : ['disabled', 'off'],
                disableHightLight: true,
                timePicker24Hour: true,
                locale:{ format:'YYYY-MM-DD' }
            }).on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD') + ' / ' + picker.endDate.format('YYYY-MM-DD'));
            });
        });
    </script>
@endpush