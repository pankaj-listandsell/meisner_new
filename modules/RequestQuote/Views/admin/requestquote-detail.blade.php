<div class="booking-d-content">
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Name')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ $quote->name }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Email')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            {{ $quote->email }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Phone No')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            {{ $quote->phone }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Service')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ $quote->service }}</p>
        </div>
    </div>

</div>
