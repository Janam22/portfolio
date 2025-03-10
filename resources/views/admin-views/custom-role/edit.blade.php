@extends('layouts.admin.app')
@section('title',translate('messages.custom_role'))
@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">

    <!-- Page Heading -->
    <div class="page-header">
        <h1 class="page-header-title mb-2 text-capitalize">
            <div class="card-header-icon d-inline-flex mr-2 img">
                <img src="{{dynamicAsset('/public/assets/admin/img/role.png')}}" alt="public">
            </div>
            <span>
                {{translate('messages.Employee_Role')}}
            </span>
        </h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.custom-role.update',[$role['id']])}}" method="post">
                        @csrf
                        @php($language=\App\Models\BusinessSetting::where('key','language')->first())
                        @php($language = $language->value ?? null)
                        @php($default_lang = str_replace('_', '-', app()->getLocale()))
                        @if($language)
                                <div class="js-nav-scroller hs-nav-scroller-horizontal">
                            <ul class="nav nav-tabs mb-4">
                                <li class="nav-item">
                                    <a class="nav-link lang_link active"
                                    href="#"
                                    id="default-link">{{translate('messages.default')}}</a>
                                </li>
                                @foreach (json_decode($language) as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link lang_link"
                                            href="#"
                                            id="{{ $lang }}-link">{{ \App\CentralLogics\Helpers::get_language_name($lang) . '(' . strtoupper($lang) . ')' }}</a>
                                    </li>
                                @endforeach
                            </ul>
                                </div>
                            @endif
                            <div class="lang_form" id="default-form">
                                <div class="form-group">
                                    <label class="input-label " for="name">{{translate('messages.role_name')}} ({{ translate('messages.default') }})</label>
                                    <input type="text" name="name[]" class="form-control" id="name" value="{{$role?->getRawOriginal('name')}}"
                                        placeholder="{{translate('messages.role_name')}}" >
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                            </div>

                            @if($language)
                                @foreach(json_decode($language) as $lang)
                                        <?php
                                            if(count($role['translations'])){
                                                $translate = [];
                                                foreach($role['translations'] as $t)
                                                {
                                                    if($t->locale == $lang && $t->key=="name"){
                                                        $translate[$lang]['name'] = $t->value;
                                                    }
                                                }
                                            }
                                        ?>
                                        <div class="d-none lang_form" id="{{$lang}}-form">
                                            <div class="form-group">
                                                <label class="input-label" for="{{$lang}}_title">{{translate('messages.role_name')}} ({{strtoupper($lang)}})</label>
                                                <input type="text" name="name[]" id="{{$lang}}_title" class="form-control" placeholder="{{translate('role_name_example')}}" value="{{$translate[$lang]['name']??''}}"  >
                                            </div>
                                            <input type="hidden" name="lang[]" value="{{$lang}}">
                                        </div>
                                    @endforeach
                            @endif


                        <label class="input-label " for="name">{{translate('messages.module_permission')}} : </label>
                        <hr>
                        <div class="row">                            
                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" name="modules[]" value="employee" class="form-check-input"
                                           id="employee" {{in_array('employee',(array)json_decode($role['modules']))?'checked':''}}>
                                    <label class="form-check-label  text-dark" for="employee">{{translate('messages.Employee')}}</label>
                                </div>
                            </div>
                            
                            <div class="check-item">
                                <div class="form-group form-check form--check">
                                    <input type="checkbox" name="modules[]" value="attendance" class="form-check-input"
                                            id="attendance" {{in_array('attendance',(array)json_decode($role['modules']))?'checked':''}}>
                                    <label class="form-check-label ml-2 ml-sm-3 text-dark" for="attendance">{{translate('messages.attendance')}}</label>
                                </div>
                            </div>
                            
                            <div class="check-item">
                                <div class="form-group form-check form--check">
                                    <input type="checkbox" name="modules[]" value="timesheet" class="form-check-input"
                                            id="timesheet" {{in_array('timesheet',(array)json_decode($role['modules']))?'checked':''}}>
                                    <label class="form-check-label ml-2 ml-sm-3 text-dark" for="timesheet">{{translate('messages.timesheet')}}</label>
                                </div>
                            </div> 

                            <div class="check-item">
                                <div class="form-group form-check form--check">
                                    <input type="checkbox" name="modules[]" value="leave" class="form-check-input"
                                            id="leave" {{in_array('leave',(array)json_decode($role['modules']))?'checked':''}}>
                                    <label class="form-check-label ml-2 ml-sm-3 text-dark" for="leave">{{translate('messages.leave_request')}}</label>
                                </div>
                            </div>
                            
                            <div class="check-item">
                                <div class="form-group form-check form--check">
                                    <input type="checkbox" name="modules[]" value="travelorder" class="form-check-input"
                                            id="travelorder" {{in_array('travelorder',(array)json_decode($role['modules']))?'checked':''}}>
                                    <label class="form-check-label ml-2 ml-sm-3 text-dark" for="travelorder">{{translate('messages.travel_order_request')}}</label>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group form-check">
                                    <input type="checkbox" name="modules[]" value="settings" class="form-check-input"
                                           id="settings"  {{in_array('settings',(array)json_decode($role['modules']))?'checked':''}}>
                                    <label class="form-check-label  text-dark" for="settings">{{translate('messages.business_settings')}}</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">{{translate('messages.update')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
@endpush
