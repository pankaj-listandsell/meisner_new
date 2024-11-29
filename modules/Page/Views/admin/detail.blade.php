@extends('admin.layouts.app')

@section('content')

    <form action="{{route('page.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ') .$translation->title :  __('Add new page') }}</h1>
                    <?php $currentUrl = !is_current_lang_default_lang() ? url((!empty($translation->slug) ? $translation->slug : '/')) : url(!empty($row->slug) ? $row->slug : '/'); ?>
                    @if($row->slug)
                        <p class="item-url-demo">{{ __('Permalink: ')}}
                            <a href="{{ $currentUrl.($translation->slug_affix ? '/'.$translation->slug_affix : '') }}"
                               target="_blank"
                            >{{ url($currentUrl.($translation->slug_affix ? '/'.$translation->slug_affix : '')) }}</a>
                        </p>
                    @endif
                </div>
                <div class="">
                    @if($row->slug)
                        <a class="btn btn-primary btn-sm" href="{{$row->getDetailUrl(request()->query('lang'))}}" target="_blank">{{ __('View page')}}</a>
                    @endif
                </div>
            </div>
            @include('admin.message')
            @if($row->id)
                @include('Language::admin.navigation')
            @endif
            <div class="lang-content-box page">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title">
                                <strong>{{ __('Page Content')}}</strong>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>{{ __('Title')}}</label>
                                    <input type="text" value="{!! clean($translation->title) !!}" placeholder="Page title" name="title" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Slug')}}</label>
                                    <input type="text" value="{!! clean($translation->slug) !!}" placeholder="Page slug" name="slug" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Slug Affix')}}</label>
                                    <input type="text" value="{{ $translation->slug_affix }}" placeholder="Page slug affix" name="slug_affix" class="form-control"/>
                                </div>

                                <div class="form-group">
                                    <label class="control-label">{{ __('Content')}}</label>

                                    <div id="booking-page-edit">

                                        <template v-if="template_id != 0">
                                            <input type="hidden" name="content" v-bind:value="JSON.stringify(items)"/>

                                            <div class="lang-content-box">
                                                <div class="templates-items-zone">
                                                    <div class="clearfix mb-3">
                                                        <button v-on:click.prevent="reloadBlockItems"
                                                                class="btn btn-primary pull-right"
                                                        >
                                                            <i class="fa fa-refresh"></i> Reload
                                                        </button>
                                                    </div>
                                                    <draggable v-model="items">
                                                        <component v-on:delete="deleteBlock"
                                                                   :block="searchBlockById(item.type)"
                                                                   :is="item.component"
                                                                   :item="item"
                                                                   v-for="(item,index) in items"
                                                                   :index=index :key="index"
                                                        ></component>
                                                    </draggable>
                                                </div>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <div class="">
                                                <textarea name="content" class="d-none has-ckeditor" cols="30" rows="10">{{$translation->content}}</textarea>
                                            </div>
                                        </template>

                                    </div>

                                    <div class="modal fade edit-block-item-modal" id="editBlockScreen" role="dialog" no-enforce-focus>
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content" v-if="block.id" id="editBlockScreenApp">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">@{{block.name}}</h5>
                                                    <button type="button" @click="hideModal" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body" v-if="show">
                                                    <vue-form-generator :key="block._key_id" :schema="{fields:block.settings}" :model="model" :options="options"></vue-form-generator>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" @click="hideModal" data-dismiss="modal">@{{template_i18n.cancel}}</button>
                                                    <button type="button" class="btn btn-primary" @click="saveModal">@{{template_i18n.save_changes}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @include('Core::admin/seo-meta/seo-meta')
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__('Publish')}}</strong></div>
                            <div class="panel-body">
                                @if(is_default_lang())
                                <div>
                                    <label><input @if($row->status=='publish') checked @endif type="radio" name="status" value="publish"> {{__("Publish")}}
                                    </label></div>
                                <div>
                                    <label><input @if($row->status=='draft') checked @endif type="radio" name="status" value="draft"> {{__("Draft")}}
                                    </label></div>
                                @endif
                                <div class="text-right">
                                    <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> {{__('Save Changes')}}</button>
                                </div>
                            </div>
                        </div>

                        @if(is_default_lang())
                            <div class="panel">
                                <div class="panel-title"><strong>{{__('Template Setting')}}</strong></div>
                                <div class="panel-body">
                                    <select name="template_id" class="form-control" id="template_id">
                                        <option value="">{{__('-- Select --')}}</option>
                                        @if($templates)
                                            @foreach($templates as $template)
                                                <option value="{{$template->id}}" @if($row->template_id == $template->id) selected @endif >{{$template->title}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-title"><strong>{{__('City Page')}}</strong></div>
                                <div class="panel-body">
                                    <select name="is_city_page" class="form-control" >
                                        <option value="0" {{ ( $row->is_city_page ?? '') == '0' ? 'selected' : ''  }}>{{__("No")}}</option>
                                        <option value="1" {{( $row->is_city_page ?? '') == '1' ? 'selected' : ''  }}>{{__('Yes')}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-title"><strong>{{__('Has shortcode')}}</strong></div>
                                <div class="panel-body">
                                    <div>
                                        <label>
                                            <input {{ $row->has_shortcode==1 ? 'checked' : '' }}
                                                   type="radio"
                                                   name="has_shortcode"
                                                   value="1"
                                            />
                                            {{__("Yes")}}
                                        </label>
                                    </div>
                                    <div>
                                        <label>
                                            <input {{ $row->has_shortcode==0 ? 'checked' : '' }}
                                                   type="radio"
                                                   name="has_shortcode"
                                                   value="0"
                                            />
                                            {{__("No")}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-title"><strong>{{__('Header Style')}}</strong></div>
                                <div class="panel-body">
                                    <select name="header_style" class="form-control" >
                                        <option value="normal" {{ ( $row->header_style ?? '') == 'normal' ? 'selected' : ''  }}>{{__("Normal")}}</option>
                                        <option value="transparent" {{( $row->header_style ?? '') == 'transparent' ? 'selected' : ''  }}>{{__('Transparent')}}</option>
                                    </select>
                                </div>
                            </div>


                            <div class="panel">
                                <div class="panel-body">
                                    <h3 class="panel-body-title">{{ __('Logo')}}</h3>
                                    <div class="form-group">
                                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('custom_logo',$row->custom_logo) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-body">
                                    <h3 class="panel-body-title">{{ __('Feature Image')}}</h3>
                                    <div class="form-group">
                                        {!! \Modules\Media\Helpers\FileHelper::fieldUpload('image_id',$row->image_id) !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('dist/admin/css/vue-select.css') }}"/>
    <?php
    $content = $translation->content_json;
    if (empty($content)) {
        $content = $row->template ?  $row->template->content_json : [];
    }
    ?>
    <script>
        var template_id = {{ $has_template ? $row->template_id : 0}};
        var current_template_title = '{{$translation->title ?? ''}}';
        var current_menu_lang = '{{request()->query('lang',app()->getLocale())}}';
        var current_template_items = {!! json_encode($content) !!};
        var all_templates = {!! json_encode($templates) !!};
    </script>
    <script>
        var template_i18n = {
            cancel: '{{__('Cancel')}}',
            save_changes: '{{__('Save changes')}}',
            delete_confirm: '{{__('Are you want to delete?')}}',
            add_new: '{{__('Add New')}}',
        };
    </script>
@endpush

@push('js')
    <script>
        $(document).ready(function () {
            $('#template_id').on("change", function(event) {
                $(this).trigger("template_changed", event.target.value);
            });
        });
        $(document).on('focusin', function(e) {
            if ($(e.target).closest(".tox-textfield").length)
                e.stopImmediatePropagation();
        });
    </script>
@endpush
