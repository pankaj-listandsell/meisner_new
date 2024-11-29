<div class="popup-contact-form">
    @php
        $logo_id = setting_item("logo_id");
        if(!empty($row->custom_logo)){
            $logo_id = $row->custom_logo;
        }
    @endphp
    @if($logo_id)
        <?php $logo = get_file_url($logo_id,'full') ?>
        <figure class="popup-contact-img">
            <img src="{{$logo}}" alt="contact logo">
        </figure>
    @endif

    <div class="contact-desc">
        @lang("Möchten Sie eine telefonische Beratung ? Hinterlassen Sie Ihre Telefonnummer! Wir rufen Sie an.")
    </div>

    <div class="popup-form-elements">
        <div class="message-alert" style="display: none"></div>
        @csrf
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="{{ trans('Name') }}">
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="phone_no" class="form-control sh-input"
                    placeholder="{{ trans('Telefonnummer') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <input type="text" name="email" class="form-control "
                    placeholder="{{ trans('E-Mail-Adresse') }}">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="terms" value="1"/>
                <span>Ich habe die <a style="color: #000;text-decoration: underline;" href="/datenschutz/" target="_blank">Datenschutzerklärung</a> zur Kenntnis genommen</span>
            </label>
        </div>
        <div class="form-group">
            <div class="captcha-img">
                <img src="{{ captcha_src() }}" id="captcha-image-pop" alt="captcha">
            </div>
            <button type="button" class="btn btn-secondary" id="refresh-captcha-pop"><img class="refs-img" src="/uploads/0000/1/2024/09/07/ref-black-icon.svg" slt="ref-img"></button>

            <div class="captcha-input">
                <input type="text" name="captcha" class="form-control"/>
            </div>
        </div>
        <button type="submit" class="btn popup-form-btn">@lang('Absenden')</button>
    </div>
</div>


<script>
    jQuery(document).ready(function($){
        $('.popup-contact-form [type=submit]').click(function (e) {
            e.preventDefault();
            let form = $(this).closest('.popup-form-elements');

            $.ajax({
                url: '{{ route('frontend.register.popup_contact') }}',
                data: {
                    'name': form.find('input[name=name]').val(),
                    'email': form.find('input[name=email]').val(),
                    'phone_no': form.find('input[name=phone_no]').val(),
                    'captcha': form.find('[name=captcha]').val(),
                    'terms': form.find('input[name=terms]').is(":checked") ? 1 : '',
                },
                method: 'POST',
                beforeSend: function () {
                    form.find('.alert-error').hide();
                    //form.find('.icon-loading').css("display", 'inline-block');
                },
                dataType: 'json',
                success: function (data) {
                    //form.find('.icon-loading').hide();
                    if (data.error === true) {
                        if (data.messages !== undefined) {
                            var errorHtml = "<ul>";
                            for (var item in data.messages) {
                                errorHtml += '<li>'+data.messages[item]+'</li>';
                            }
                            errorHtml += "</ul>";
                            form.find('.message-alert').show().html(errorHtml);
                        }
                        return;
                    }
                    if (data.message) {
                        form.find('.message-alert').show().html('<div class="alert alert-success">' + data.message + '</div>');
                        form.find('input').val('');
                        form.find('input[type=checkbox]').prop('checked', false);
                        form.find('.captcha-img').html(data.data);
                    }
                },
                error: function (e) {
                    form.find('.icon-loading').hide();

                    if (typeof e.responseJSON !== 'undefined') {
                        var html = ajax_error_to_string(e);
                        if (html) {
                            form.find('.message-alert').show().html('<div class="alert alert-danger">' + html + '</div>');
                        }
                        if (e.responseJSON.captcha_img) {
                            form.find('.captcha-img').html(e.responseJSON.captcha_img);
                        }
                    }

                }
            });
        })
    });
    function ajax_error_to_string(e) {
        if (typeof e.responseJSON !== 'undefined') {
            if (e.responseJSON.errors) {
                var html = [];
                for (var k in e.responseJSON.errors) {
                    html.push(e.responseJSON.errors[k].join("<br/>"));
                }

                return html.join("<br/>");
            }

            if (e.responseJSON.message) {
                return e.responseJSON.message;
            }
        }
    }
</script>


@push('js')
<script>
$('#refresh-captcha-pop').on('click', function() {
    $.get('{{ route('captcha.refresh') }}', function (data) {
        $('#captcha-image-pop').attr('src', data.captcha);
    });
});
</script>
@endpush

@push('css')
    <style>
        .popup-contact-form {
            width: 500px;
            padding: 30px;
        }
        .popup-contact-img img {
            max-height: 50px;
        }
    </style>
@endpush
