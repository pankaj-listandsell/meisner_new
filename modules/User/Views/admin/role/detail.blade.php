@extends('admin.layouts.app')
@section('content')
    <form action="{{route('user.admin.role.store', ['id' => ($row->id) ? $row->id : '-1'])}}" method="post">
        @csrf
        @include('admin.message')
        <div class="container">
            <div class="d-flex justify-content-between mb20">
                <div class="">
                    <h1 class="title-bar">{{$row->id ? 'Edit: '.$row->name : 'Add new role'}}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3"></div>
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-body">
                            <h3 class="panel-body-title">{{ __('Role Content')}} </h3>
                            <div class="form-group">
                                <label>{{ __('Name')}}</label>
                                <input type="text" value="{{$row->name}}" placeholder="{{ __('Role Name')}}" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>{{ __('Is Guest Role')}}</label>
                                <div>
                                    <input type="radio" value="1" name="is_guest" id="guest_yes"
                                        {{ $row->is_guest == '1' ? 'checked' : '' }}
                                    />
                                    <label for="guest_yes" class="mr-2">{{ __('Yes')}}</label>
                                    <input type="radio" value="0" name="is_guest" id="guest_no"
                                        {{ $row->is_guest == '0' ? 'checked' : '' }}
                                    />
                                    <label for="guest_no" class="mr-2">{{ __('No')}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>&nbsp;</span>
                        <button class="btn btn-primary" type="submit">{{ __('Save Change')}}</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
@endsection
