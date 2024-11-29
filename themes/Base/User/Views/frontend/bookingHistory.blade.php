@section('content')
    <h2 class="title-bar no-border-bottom booking">
        {{__("Booking History")}}
    </h2>
    @include('admin.message')
    <div class="booking-history-manager">
        <div class="tabbable">
            <ul class="nav nav-tabs ht-nav-tabs">
                <?php $status_type = Request::query('status'); ?>
                <li class="@if(empty($status_type)) active @endif">
                    <a href="{{route("user.booking_history")}}">{{__("All Booking")}}</a>
                </li>

                    <!--
                <form method="get" action="{{ route('user.booking_history')}}"
                      class="filter-form filter-form-right d-flex justify-content-end flex-column flex-sm-row"
                      role="search">
                    <div class="mb-3">
                        <label class="d-block" for="exampleInputEmail1">{{ __("Status") }}</label>
                        <select name="status" class="form-control">
                            <option value="">{{ __('-- All Status --')}} </option>
                            @foreach($booking_status as $item)
                                <option value="{{ $item->status }}"
                                        @if(Request()->status == $item->status) selected @endif>{{booking_status_to_text($item->status)}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button class="btn-info btn btn-icon btn_search" type="submit">{{__('Search')}}</button>
                </form>
                -->
            </ul>

            @if(!empty($bookings) and $bookings->total() > 0)
                <div class="tab-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-booking-history">
                            <thead>
                            <tr>
                                <th>{{__("Tour")}}</th>
                                <th>{{__("Date")}}</th>
                                <th>{{__("Members")}}</th>
                                <th>{{__("Transport")}}</th>
                                <th>{{__("Total")}}</th>
                                <th>{{__("Paid")}}</th>
                                <th>{{__("Remain")}}</th>
                                <th>{{__("Action")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)
                                @include('Tour::frontend.bookingHistory.loop')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="bravo-pagination">
                        {{$bookings->appends(request()->query())->links()}}
                    </div>
                </div>
            @else
                {{__("No Booking History")}}
            @endif
        </div>
        <div class="modal" tabindex="-1" id="modal_booking_detail">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{__('Booking ID: #')}}<span class="booking_r_id"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body mc-wrapper">
                        <div class="d-flex justify-content-center">{{__("Loading...")}}</div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('Close')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>

        jQuery(document).ready(function ($) {
            $('.btn-booking-detail').on('click', function (e) {
                e.preventDefault();
                var booking_id = $(this).attr('data-id');
                $.post('{{ route('user.booking.modal_detail') }}', {
                        booking_id: booking_id,
                    }, function (html) {
                        $('#modal_booking_detail').modal('show');
                        $('.booking_r_id').html(booking_id);
                        $('#modal_booking_detail .mc-wrapper').html(html);
                    }
                )
            });
        });


        /*$('#modal_booking_detail').on('show.bs.modal', function (e) {


            var booking_id = btn.data('id');
            $(this).find('.user_id').html(btn.data('id'));
            $(this).find('.modal-body').html('<div class="d-flex justify-content-center">{{__("Loading...")}}</div>');
            var modal = $(this);
            $.post('{{ route('user.booking.modal_detail') }}', {
                    booking_id: booking_id,
                }, function (html) {
                    modal.find('.modal-body').html(html);
                }
            )
        })*/
    </script>
@endpush

