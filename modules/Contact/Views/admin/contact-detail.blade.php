<div class="booking-d-content">
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Name')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ $contact->fullName }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Email')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            {{ $contact->email }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Phone No')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            {{ $contact->phone }}
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Nationality')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ $contact->nationality }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Subject')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ $contact->subject }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-xs-6">
            <label>@lang('Message')</label>
        </div>
        <div class="col-md-6 col-xs-6">
            <p>{{ $contact->message }}</p>
        </div>
    </div>
</div>
