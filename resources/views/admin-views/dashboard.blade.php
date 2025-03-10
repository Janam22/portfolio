@extends('layouts.admin.app')

@section('title',\App\Models\SystemSetting::where(['key'=>'system_name'])->first()->value??'Dashboard')
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        @if(auth('admin')->user()->role_id == 1)
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
        @else
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">{{translate('messages.welcome')}}, {{auth('admin')->user()->f_name}}.</h1>
                    <p class="page-header-text">{{translate('messages.Hello,_here_you_can_manage_your_roles.')}}</p>
                </div>                
            </div>
        </div>
        <!-- End Page Header -->
        @endif
    </div>
@endsection