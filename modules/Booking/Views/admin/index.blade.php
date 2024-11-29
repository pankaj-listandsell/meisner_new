@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between mb20">
            <h1 class="title-bar">{{ __('All Booking Submissions')}}</h1>
        </div>
        @include('admin.message')
        <div class="filter-div d-flex justify-content-between ">
            <div class="col-left">
                @if(!empty($rows))
                <form method="post" action="{{route('booking.admin.bulkEdit')}}" class="filter-form filter-form-left d-flex justify-content-start">
                    {{csrf_field()}}
                    <select name="action" class="form-control">
                        <option value="">{{__(" Bulk Actions ")}}</option>
                        <option value="delete">{{__(" Delete ")}}</option>
                    </select>
                    <button data-confirm="{{__("Do you want to delete?")}}" class="btn-info btn btn-icon dungdt-apply-form-btn" type="button">{{__('Apply')}}</button>
                </form>
               @endif
            </div>
            <div class="col-left">
               <form method="get" action="{{route('booking.admin.index')}} " class="filter-form filter-form-right d-flex justify-content-end" role="search">
                    <input  type="text" name="s" value="{{ Request()->s }}" placeholder="{{__('Search...')}}" class="form-control">
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
                                <th >{{ __('Name')}}</th>
                                <th class="author">{{ __('Email')}} </th>
                                <th>{{ __('Telephone no')}} </th>
                                <th class="date">{{__('Date')}} </th>
                                <th>{{__('Action')}} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($rows->total() > 0)
                                @foreach($rows as $row)
                                    <tr>
                                        <td><input type="checkbox" name="ids[]" class="check-item" value="{{$row->id}}"></td>
                                        <td class="title">
                                            {{ $row->full_name }}
                                        </td>
                                        <td class="author">{{$row->contact_email ?? ''}} </td>
                                        <td>{{ $row->contact_telephone_no }} </td>
                                        <td class="date">{{ display_datetime($row->preferred_date)}}</td>
                                        <td>
                                            <a class="btn btn-xs btn-primary btn-info-booking detail-btn"
                                               href="#" data-id="{{ $row->id }}">
                                                <i class="fa fa-info-circle"></i> Details
                                            </a>
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
    <script>


        jQuery(document).ready(function ($) {
            $('.detail-btn').on('click', function (e) {
                e.preventDefault();
                var booking_id = $(this).attr('data-id');
                $.post('{{ route('booking.admin.modal_detail') }}', {
                    booking_id: booking_id,
                    }, function (html) {
                        $('#booking_detail_modal').modal('show');
                        $('.booking_detail_id').html(booking_id);
                        $('#booking_detail_modal .mc-wrapper').html(html);
                    }
                )
            });
        });

    </script>
@endpush
