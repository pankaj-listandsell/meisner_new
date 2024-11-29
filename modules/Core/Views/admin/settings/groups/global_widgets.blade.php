<?php $lang = request()->has('lang') ? request()->get('lang') : get_default_lang(); ?>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{ __('Counter Section Information') }}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h5>{{ __('First Counter') }} </h5>
                        <div class="form-group">
                            <label class="">{{ __('Title') }}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="first_counter_title"
                                    value="{{ setting_item_with_lang('first_counter_title', $lang) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">{{ __('Subtitle') }}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="first_counter_subtitle"
                                    value="{{ setting_item_with_lang('first_counter_subtitle', $lang) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Icon') }}</label>
                            <div class="form-controls form-group-image">
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('first_counter_icon', setting_item('first_counter_icon')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h5>{{ __('Second Counter') }} </h5>
                        <div class="form-group">
                            <label class="">{{ __('Title') }}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="second_counter_title"
                                    value="{{ setting_item_with_lang('second_counter_title', $lang) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">{{ __('Subtitle') }}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="second_counter_subtitle"
                                    value="{{ setting_item_with_lang('second_counter_subtitle', $lang) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Icon') }}</label>
                            <div class="form-controls form-group-image">
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('second_counter_icon', setting_item('second_counter_icon')) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <h5>{{ __('Third Counter') }} </h5>
                        <div class="form-group">
                            <label class="">{{ __('Title') }}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="third_counter_title"
                                    value="{{ setting_item_with_lang('third_counter_title', $lang) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">{{ __('Subtitle') }}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="third_counter_subtitle"
                                    value="{{ setting_item_with_lang('third_counter_subtitle', $lang) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Icon') }}</label>
                            <div class="form-controls form-group-image">
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('third_counter_icon', setting_item('third_counter_icon')) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h5>{{ __('Fourth Counter') }} </h5>
                        <div class="form-group">
                            <label class="">{{ __('Title') }}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="fourth_counter_title"
                                    value="{{ setting_item_with_lang('fourth_counter_title', $lang) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">{{ __('Subtitle') }}</label>
                            <div class="form-controls">
                                <input type="text" class="form-control" name="fourth_counter_subtitle"
                                    value="{{ setting_item_with_lang('fourth_counter_subtitle', $lang) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('Icon') }}</label>
                            <div class="form-controls form-group-image">
                                {!! \Modules\Media\Helpers\FileHelper::fieldUpload('fourth_counter_icon', setting_item('fourth_counter_icon')) !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{ __('Any Questions Section Information') }}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">

                <div class="form-group">
                    <label class="">{{ __('Title') }}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="any_questions_title"
                            value="{{ setting_item_with_lang('any_questions_title', $lang) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Desc")}}</label>
                    <div class="form-controls">
                        <textarea name="any_questions_desc" class="form-control has-ckeditor" cols="30"
                                  rows="7">{{setting_item_with_lang('any_questions_desc', $lang)}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{ __('Contact Title') }}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="any_questions_contact_title"
                            value="{{ setting_item_with_lang('any_questions_contact_title', $lang) }}">
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
<hr>
{{-- <div class="row">
<div class="col-sm-4">
    <h3 class="form-group-title">{{ __('Five Steps Section Information') }}</h3>
</div>
<div class="col-sm-8">
    <div class="panel">
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12">
                <div class="form-group">
                    <label class="">{{ __('Main Title') }}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="five_steps_main_title"
                            value="{{ setting_item_with_lang('five_steps_main_title', $lang) }}">
                    </div>
                </div>
            </div>
                <div class="col-sm-6">
                    <h5>{{ __('First Step') }} </h5>
                    <div class="form-group">
                        <label>{{ __('Icon') }}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('first_five_steps_icon', setting_item('first_five_steps_icon')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{ __('Title') }}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="first_five_steps_title"
                                value="{{ setting_item_with_lang('first_five_stepstitle', $lang) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{ __('Subtitle') }}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="first_five_steps_subtitle"
                                value="{{ setting_item_with_lang('first_five_steps_subtitle', $lang) }}">
                        </div>
                    </div>

                </div>
                <div class="col-sm-6">
                    <h5>{{ __('Second Step') }} </h5>
                    <div class="form-group">
                        <label>{{ __('Icon') }}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('second_five_steps_icon', setting_item('second_five_steps_icon')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{ __('Title') }}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="second_five_steps_title"
                                value="{{ setting_item_with_lang('second_five_steps_title', $lang) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{ __('Subtitle') }}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="second_five_steps_subtitle"
                                value="{{ setting_item_with_lang('second_five_steps_subtitle', $lang) }}">
                        </div>
                    </div>

                </div>

                <div class="col-sm-6">
                    <h5>{{ __('Third Step') }} </h5>
                    <div class="form-group">
                        <label>{{ __('Icon') }}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('third_five_steps_icon', setting_item('third_five_steps_icon')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{ __('Title') }}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="third_five_steps_title"
                                value="{{ setting_item_with_lang('third_five_steps_title', $lang) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{ __('Subtitle') }}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="third_five_steps_subtitle"
                                value="{{ setting_item_with_lang('third_five_steps_subtitle', $lang) }}">
                        </div>
                    </div>

                </div>
                <div class="col-sm-6">
                    <h5>{{ __('Fourth Step') }} </h5>
                    <div class="form-group">
                        <label>{{ __('Icon') }}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('fourth_five_steps_icon', setting_item('fourth_five_steps_icon')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{ __('Title') }}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="fourth_five_steps_title"
                                value="{{ setting_item_with_lang('fourth_five_steps_title', $lang) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{ __('Subtitle') }}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="fourth_five_steps_subtitle"
                                value="{{ setting_item_with_lang('fourth_five_steps_subtitle', $lang) }}">
                        </div>
                    </div>

                </div>
                <div class="col-sm-6">
                    <h5>{{ __('Fifth Step') }} </h5>
                    <div class="form-group">
                        <label>{{ __('Icon') }}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('fifth_five_steps_icon', setting_item('fifth_five_steps_icon')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{ __('Title') }}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="fifth_five_steps_title"
                                value="{{ setting_item_with_lang('fifth_five_steps_title', $lang) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="">{{ __('Subtitle') }}</label>
                        <div class="form-controls">
                            <input type="text" class="form-control" name="fifth_five_steps_subtitle"
                                value="{{ setting_item_with_lang('fifth_five_steps_subtitle', $lang) }}">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</div>
<hr> --}}
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{ __('Request for Service Section Information') }}</h3>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="">{{ __('Title') }}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="request_service_title"
                            value="{{ setting_item_with_lang('request_service_title', $lang) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Desc")}}</label>
                    <div class="form-controls">
                        <textarea name="request_service_desc" class="form-control has-ckeditor" cols="30"
                                  rows="7">{{setting_item_with_lang('request_service_desc', $lang)}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{ __('Button Text') }}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="request_service_button_text"
                            value="{{ setting_item_with_lang('request_service_button_text', $lang) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{ __('Button Link') }}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="request_service_button_link"
                            value="{{ setting_item_with_lang('request_service_button_link', $lang) }}">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="">{{ __('Second Button Text') }}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="request_service_second_button_text"
                            value="{{ setting_item_with_lang('request_service_second_button_text', $lang) }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{ __('Second Button Link') }}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="request_service_second_button_link"
                            value="{{ setting_item_with_lang('request_service_second_button_link', $lang) }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('js')
    <script src="{{ asset('libs/ace/src-min-noconflict/ace.js') }}" type="text/javascript" charset="utf-8"></script>
    <script>
        (function($) {
            $('.ace-editor').each(function() {
                var editor = ace.edit($(this).attr('id'));
                editor.setTheme("ace/theme/" + $(this).data('theme'));
                editor.session.setMode("ace/mode/" + $(this).data('mod'));
                var me = $(this);

                editor.session.on('change', function(delta) {
                    // delta.start, delta.end, delta.lines, delta.action
                    me.next('textarea').val(editor.getValue());
                });
            });
        })(jQuery)
    </script>
@endpush
