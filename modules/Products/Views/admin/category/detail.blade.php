@extends('admin.layouts.app')
@section('content')
    <form action="{{route('products.admin.category.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
        @csrf
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit: ').$row->name : __('Add new category')}}</h1>
                </div>

            </div>
            @include('admin.message')
            @include('Language::admin.navigation')
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-body">
                                <h3 class="panel-body-title"> {{ __('Category Content')}}</h3>
                                @include('Products::admin/category/form')
                            </div>
                        </div>
                        @include('Core::admin/seo-meta/seo-meta')
                    </div>
                    <div class="col-md-3">
                        <div class="panel">
                            <div class="panel-title"><strong>{{ __('Publish')}}</strong></div>
                            <div class="panel-body">
                                @if(is_default_lang())
                                    <div class="form-group">
                                        <div>
                                            <label><input @if($row->status=='publish') checked @endif type="radio" name="status" value="publish"> {{ __('Publish')}}
                                            </label>
                                        </div>
                                        <div>
                                            <label><input @if($row->status=='draft') checked @endif type="radio" name="status" value="draft"> {{ __('Draft')}}
                                            </label>
                                        </div>
                                    </div>
                                @endif

                                <button class="btn btn-success" type="submit"><i class="fa fa-save"></i> {{ __('Save Change')}}</button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
@endsection
