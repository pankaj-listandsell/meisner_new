@extends('admin.layouts.app')

@section('content')
    <form action="{{route('news.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post" class="dungdt-form">
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit blog: ').$row->title : __('Add new blog')}}</h1>
                    @if($translation->slug)
                        <p class="item-url-demo">{{__("Permalink")}}: {{ route('news.detail', ['slug' => $translation->slug])  }}</p>
                    @endif
                </div>
                <div class="">
                    @if($translation->slug)
                        <a class="btn btn-primary btn-sm" href="{{ route('news.detail', ['slug' => $translation->slug])  }}" target="_blank">{{__("View Post")}}</a>
                    @endif
                </div>
            </div>
            @include('admin.message')
            @include('Language::admin.navigation')
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title"><strong>{{ __('Blog content')}}</strong></div>
                            <div class="panel-body">
                                @csrf
                                @include('News::admin/news/form',['row'=>$row])
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
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label>{{  __('Category')}} </label>
                                        <select name="cat_id" class="form-control">
                                            <option value="">{{ __('-- Please Select --')}} </option>
                                            <?php
                                            $traverse = function ($categories, $prefix = '') use (&$traverse, $row) {
                                                foreach ($categories as $category) {
                                                    $selected = '';
                                                    if ($row->cat_id == $category->id)
                                                        $selected = 'selected';
                                                    printf("<option value='%s' %s>%s</option>", $category->id, $selected, $prefix . ' ' . $category->name);
                                                    $traverse($category->children, $prefix . '-');
                                                }
                                            };
                                            $traverse($categories);
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if(is_default_lang())
                            <div class="panel">
                                <div class="panel-body">
                                    <h3 class="panel-body-title"> {{ __('Feature Image')}}</h3>
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
