@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="dashboard-page">
            <h4 class="welcome-title text-uppercase">{{__('Welcome :name!',['name'=>Auth::user()->nameOrEmail])}}</h4>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <div class="dashboard-report-card card info">
                    <div class="card-content">
                        <span class="card-title">Forms</span>
                        <span class="card-amount">{{ $totalForms }}</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-pricetags"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="dashboard-report-card card success">
                    <div class="card-content">
                        <span class="card-title">Contacts</span>
                        <span class="card-amount">{{ $totalContacts }}</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-contact"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="dashboard-report-card card pink">
                    <div class="card-content">
                        <span class="card-title">Pages</span>
                        <span class="card-amount">{{ $totalPages }}</span>
                    </div>
                    <div class="card-media">
                        <i class="icon ion-ios-book"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush
