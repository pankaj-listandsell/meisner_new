@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __('All Booking Products')}}</h1>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                <form method="post" action="{{route('booking.admin.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                    {{csrf_field()}}
                    <select name="action" class="form-control">
                        <option value="">{{__(" Bulk Actions ")}}</option>
                        {{-- <option value="delete">{{__(" Delete ")}}</option> --}}
                    </select>
                    <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                </form>
               @endif
            </div>
            <div class="col-left">
               <form method="get" action="{{route('booking_products.admin.index')}} " class="filter-form filter-form-right d-flex justify-content-end" role="search">
                    <input  type="text" name="search" value="{{ Request()->search }}" placeholder="{{__('Search...')}}" class="form-control">
                    <button class="btn-info btn btn-icon btn_search"  type="submit">{{__('Search')}}</button>
                </form>
            </div>
        </div>
        <div class="clearfix">
            <div class="pull-right"><i>{{__('Found :total items',['total'=>$rows->total()])}}</i></div>
        </div>
        <div class="panel">
            <div class="panel-body">
                <form action="" class="bravo-form-item">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="60px"><input type="checkbox" class="check-all"></th>
                                <th >{{ __('Booking Id')}}</th>
                                <th class="author">{{ __('Full Name')}} </th>
                                <th>{{ __('Email')}} </th>
                                <th class="city">{{__('City')}} </th>
                                <th class="date">{{__('Date')}} </th>
                                <th class="address">{{__('Address')}} </th>
                                <th>{{__('Action')}} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($rows->total() > 0)
                                @foreach($rows as $row)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}"></td>
                                        <td class="title">
                                            {{ $row->booking_id }}
                                        </td>
                                        <td class="author">{{$row->full_name ?? ''}} </td>
                                        <td>{{ $row->email }} </td>
                                        <td>{{ $row->city }}</td>
                                        <td class="date">{{ display_date($row->date)}}</td>
                                        <td>{{ $row->address }} </td>
                                        <td>
                                            {{-- <a href="{{route('products.admin.edit',['id'=>$row->id])}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> {{__('Edit')}}</a> --}}

                                            <a class="btn btn-xs btn-primary btn-info-booking" title="View Booking Detail" href="{{route('booking_products.admin.view',['id'=>$row->id])}}" data-id="{{ $row->id }}"> <i class="fa fa-info-circle"></i> Details </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">{{__("No data")}}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </form>
                {{$rows->appends(request()->query())->links()}}
            </div>
        </div>
        <div class="modal" tabindex="-1" id="booking_detail_modal" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Booking ID: #<span class="booking_detail_id"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body mc-wrapper"><div class="booking-d-content"></div>
                    </div>
                </div>
            </div>
    </div>

@endsection

@push('js')

@endpush
