<?php $lang = request()->has('lang') ? request()->get('lang') : get_default_lang(); ?>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Site Information")}}</h3>
        <p class="form-group-desc">{{__('Information of your website for customer and goole')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="">{{__("Site title")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="site_title"
                               value="{{setting_item_with_lang('site_title', $lang)}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{__("Email")}}</label>
                    <div class="form-controls">
                        <input type="email" class="form-control" name="email"
                               value="{{setting_item_with_lang('email', $lang)}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{__("Phone No")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="phone_no"
                               value="{{setting_item_with_lang('phone_no', $lang)}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{__("Phone No Link")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="phone_no_link"
                               value="{{setting_item_with_lang('phone_no_link', $lang)}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Site Desc")}}</label>
                    <div class="form-controls">
                        <textarea name="site_desc" class="form-control" cols="30"
                                  rows="7">{{setting_item_with_lang('site_desc', $lang)}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Map Iframe")}}</label>
                    <div class="form-controls">
                        <div class="form-controls">
                            <textarea name="map" class="d-none has-ckeditor" cols="30"
                                      rows="10">{{setting_item_with_lang('map', $lang) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Address")}}</label>
                    <div class="form-controls">
                        <div class="form-controls">
                            {{-- <input type="text" class="form-control" name="address" value=""> --}}
                            <textarea name="address" class="form-control" cols="30"
                                      rows="10">{{setting_item_with_lang('address', $lang) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Address Link")}}</label>
                    <div class="form-controls">
                        <div class="form-controls">
                            <input type="text" class="form-control" name="address_link"
                               value="{{setting_item_with_lang('address_link', $lang)}}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{__("VAT")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="vat"
                               value="{{setting_item_with_lang('vat', $lang)}}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="">{{__("Maximaler Bestellwert")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="max_order_amount"
                               value="{{setting_item_with_lang('max_order_amount', $lang)}}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
@if(has_admin_default_lang())
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__('Language')}}</h3>
            <p class="form-group-desc">{{__('Change language of your websites')}}</p>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label>{{__("Select default language")}}</label>
                        <div class="form-controls">
                            <select name="site_locale" class="form-control">
                                <option value="">{{__("-- Default --")}}</option>
                                @php
                                    $langs = \Modules\Language\Models\Language::getActive();
                                @endphp

                                @foreach($langs as $lang)
                                    <option @if($lang->locale == setting_item('site_locale') ) selected
                                            @endif value="{{$lang->locale}}">{{$lang->name}} - ({{$lang->locale}})
                                    </option>
                                @endforeach
                            </select>
                            <p><i><a href="{{route('language.admin.index')}}">{{__("Manage languages here")}}</a></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if(has_admin_default_lang())
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <h3 class="form-group-title">{{__('Menu & Page')}}</h3>
        </div>
        <div class="col-sm-8">
            <div class="panel">
                <div class="panel-body">
                    <div class="form-group">
                        <label>{{__("Page for Homepage")}}</label>
                        <div class="form-controls">
                                <?php
                                $template = setting_item('home_page_id') ? \Modules\Page\Models\Page::find(setting_item('home_page_id')) : false;

                                \App\Helpers\AdminForm::select2('home_page_id', [
                                    'configs' => [
                                        'ajax' => [
                                            'url' => route('page.admin.getForSelect2'),
                                            'dataType' => 'json'
                                        ]
                                    ]
                                ],
                                    !empty($template->id) ? [$template->id, $template->title] : false
                                )
                                ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>{{__("Header menu")}}</label>
                        <div class="form-controls">
                                <?php
                                $menu = setting_item('primary_menu_id') ? \Modules\Core\Models\Menu::find(setting_item('primary_menu_id')) : false;

                                \App\Helpers\AdminForm::select2('primary_menu_id', [
                                    'configs' => [
                                        'ajax' => [
                                            'url' => route('core.admin.menu.getForSelect2'),
                                            'dataType' => 'json'
                                        ]
                                    ]
                                ],
                                    !empty($menu->id) ? [$menu->id, $menu->name] : false
                                )
                                ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<hr>
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__('Header & Footer Settings')}}</h3>
        <p class="form-group-desc">{{__('Change your options')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                @if(has_admin_default_lang())
                    <div class="form-group">
                        <label>{{__("Terms & Conditions page")}}</label>
                        <div class="form-controls">
                                <?php
                                $template = !empty(setting_item_with_lang('booking_term_conditions',  $lang)) ? \Modules\Page\Models\Page::find(setting_item_with_lang('booking_term_conditions',  $lang)) : false;
                                \App\Helpers\AdminForm::select2('booking_term_conditions', [
                                    'configs' => [
                                        'ajax' => [
                                            'url' => route('page.admin.getForSelect2'),
                                            'dataType' => 'json'
                                        ]
                                    ]
                                ],
                                    !empty($template->id) ? [$template->id, $template->title] : false
                                )
                                ?>
                        </div>
                    </div>
                @endif
                @if(has_admin_default_lang())
                    <div class="form-group">
                        <label>{{__("Logo")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('logo_id',setting_item('logo_id')) !!}
                        </div>
                    </div>
                @endif
                @if(has_admin_default_lang())
                    <div class="form-group">
                        <label>{{__("Footer Logo")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('footer_logo_id',setting_item('footer_logo_id')) !!}
                        </div>
                    </div>
                @endif
                @php do_action(\Modules\Core\Hook::CORE_SETTING_AFTER_LOGO) @endphp
                @if(has_admin_default_lang())
                    <div class="form-group">
                        <label class="">{{__("Favicon")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('site_favicon',setting_item('site_favicon')) !!}
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label>{{__("Topbar Left Text")}}</label>
                    <div class="form-controls">
                        <div id="topbar_left_text_editor" class="ace-editor" style="height: 400px" data-theme="textmate"
                             data-mod="html">{{setting_item_with_lang('topbar_left_text', $lang)}}</div>
                        <textarea class="d-none"
                                  name="topbar_left_text"> {{ setting_item_with_lang('topbar_left_text', $lang) }} </textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Footer Text Left")}}</label>
                    <div class="form-controls">
                        <textarea name="footer_text_left" class="d-none has-ckeditor" cols="30"
                                  rows="10">{{setting_item_with_lang('footer_text_left', $lang) }}</textarea>
                    </div>
                </div>
                @php do_action(\Modules\Core\Hook::CORE_SETTING_AFTER_FOOTER) @endphp
            </div>
        </div>
    </div>
</div>
<hr>
@if(false)
<div class="row">
    <div class="col-sm-4">
        <h3 class="form-group-title">{{__("Page contact settings")}}</h3>
        <p class="form-group-desc">{{__('Settings for contact page')}}</p>
    </div>
    <div class="col-sm-8">
        <div class="panel">
            <div class="panel-body">
                <div class="form-group">
                    <label class="">{{__("Contact title")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="page_contact_title"
                               value="{{setting_item_with_lang('page_contact_title', $lang,"We'd love to hear from you")}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Contact sub title")}}</label>
                    <div class="form-controls">
                        <input type="text" class="form-control" name="page_contact_sub_title"
                               value="{{setting_item_with_lang('page_contact_sub_title', $lang,"Send us a message and we'll respond as soon as possible")}}">
                    </div>
                </div>
                <div class="form-group">
                    <label>{{__("Contact Desc")}}</label>
                    <div class="form-controls">
                        <textarea name="page_contact_desc" class="d-none has-ckeditor" cols="30"
                                  rows="7">{{setting_item_with_lang('page_contact_desc', $lang) }}</textarea>
                    </div>
                </div>
                @if(has_admin_default_lang())
                    <div class="form-group">
                        <label>{{__("Contact Featured Image")}}</label>
                        <div class="form-controls form-group-image">
                            {!! \Modules\Media\Helpers\FileHelper::fieldUpload('page_contact_image',setting_item('page_contact_image')) !!}
                        </div>
                    </div>
                @endif
                @php do_action(\Modules\Core\Hook::CORE_SETTING_AFTER_CONTACT) @endphp
            </div>
        </div>
    </div>
</div>
@endif
@push('js')
    <script src="{{asset('libs/ace/src-min-noconflict/ace.js')}}" type="text/javascript" charset="utf-8"></script>
    <script>
        (function ($) {
            $('.ace-editor').each(function () {
                var editor = ace.edit($(this).attr('id'));
                editor.setTheme("ace/theme/" + $(this).data('theme'));
                editor.session.setMode("ace/mode/" + $(this).data('mod'));
                var me = $(this);

                editor.session.on('change', function (delta) {
                    // delta.start, delta.end, delta.lines, delta.action
                    me.next('textarea').val(editor.getValue());
                });
            });
        })(jQuery)
    </script>
@endpush
