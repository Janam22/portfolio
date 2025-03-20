@extends('layouts.admin.app')

@section('title',\App\Models\SystemSetting::where(['key'=>'system_name'])->first()->value??'Dashboard')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
                <div class="page--header-title">
                    <h1 class="page-header-title">{{translate('messages.welcome')}}, {{auth('admin')->user()->f_name}}.</h1>
                    <p class="page-header-text">{{translate('messages.Hello,_here_you_can_manage_your_system.')}}</p>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
         
        <!-- Stats -->
        <div class="card mb-3">
            <div class="card-body pt-0">
                <div id="order_stats_top">
                    @include('admin-views.partials._dashboard-statics')
                </div>
            </div>
        </div>

    </div>
@endsection