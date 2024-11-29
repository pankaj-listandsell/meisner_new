@extends('admin.layouts.app')

@section('content')
    <form action="{{route('redirection.admin.store',['id'=>($row->id) ? $row->id : '-1','lang'=>request()->query('lang')])}}" method="post">
        @csrf
        <div class="container-fluid">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? __('Edit redirection') : __('Add redirection')}}</h1>
                </div>
            </div>
            @include('admin.message')
            <div class="lang-content-box">
                <div class="row">
                    <div class="col-md-9">
                        <div class="panel">
                            <div class="panel-title"><strong>{{__("Content")}}</strong></div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label>{{__("From Url")}} <span class="text-danger">*</span></label>
                                    <input type="text"
                                           value="{{old('from_url', $row->from_url)}}"
                                           name="from_url"
                                           placeholder="{{__("From url")}}"
                                           class="form-control"
                                           required
                                    />
                                </div>
                                <div class="form-group">
                                    <label>{{__("To Url")}} <span class="text-danger">*</span></label>
                                    <input type="text"
                                           value="{{old('to_url', $row->to_url)}}"
                                           name="to_url"
                                           placeholder="{{__("To url")}}"
                                           class="form-control"
                                           required
                                    />
                                </div>
                            </div>
                        </div>
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
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

