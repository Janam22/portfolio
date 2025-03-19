@extends('layouts.admin.app')

@section('title',translate('messages.Update_resume_details'))

@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h2 class="page-header-title text-capitalize">
                        <div class="card-header-icon d-inline-flex mr-2 img">
                            <img src="{{dynamicAsset('public/assets/admin/img/sub-category.png')}}" alt="">
                        </div>
                        <span>
                            {{translate('messages.resume_details_Update')}}
                        </span>
                    </h2>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.resumedetail.update',[$resumedetail['id']])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @php($language=\App\Models\SystemSetting::where('key','language')->first())
                    @php($language = $language->value ?? null)
                    @php($default_lang = str_replace('_', '-', app()->getLocale()))
                    @if($language)
                                <div class="js-nav-scroller hs-nav-scroller-horizontal">
                        <ul class="nav nav-tabs mb-4">
                            <li class="nav-item">
                                <a class="nav-link lang_link  active" href="#" id="default-link">{{ translate('Default')}}</a>
                            </li>
                            @foreach(json_decode($language) as $lang)
                                <li class="nav-item">
                                    <a class="nav-link lang_link " href="#" id="{{$lang}}-link">{{\App\CentralLogics\Helpers::get_language_name($lang).'('.strtoupper($lang).')'}}</a>
                                </li>
                            @endforeach
                        </ul>
                                </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-12">
                            @if ($language)
                            <div class="lang_form" id="default-form">

                            <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlSelect1">{{ translate('messages.resume_type') }}<span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="{{ translate('messages.Required.')}}"> *
                                            </span></label>
                                        <select name="resume_type" id="resume_type"
                                            class="form-control js-select2-custom get-request"
                                            oninvalid="this.setCustomValidity('Select Service')">
                                                <option value="" selected disabled>{{ translate('Select_resume_type') }}</option>
                                                <option value="ed" {{ $resumedetail->resume_type == 'ed' ? 'selected' : '' }}>{{ translate('Education') }}</option>
                                                <option value="ex" {{ $resumedetail->resume_type == 'ex' ? 'selected' : '' }}>{{ translate('Experience') }}</option>
                                        </select>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="input-label"
                                        for="default_name">{{ translate('messages.degree_/_designation') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span>
                                    </label>
                                    <input type="text" name="title[]"
                                        class="form-control" value="{{$resumedetail?->getRawOriginal('title')}}"
                                        placeholder="{{ translate('messages.SEE_/_Web_Developer') }}">
                                </div>
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{ translate('messages.date_range') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span></label>
                                    <input type="text" name="date_range[]" class="form-control" value="{{$resumedetail?->getRawOriginal('date_range')}}" placeholder="{{ translate('messages.2022_-_2025')}}">
                                </div>
                                <br>
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{ translate('messages.name_/_address') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span></label>
                                    <input type="text" name="name_address[]" class="form-control" value="{{$resumedetail?->getRawOriginal('name_address')}}" placeholder="{{ translate('messages.kmc_college,_bagbazar_kathmandu')}}">
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                                <br>
                                <div class="form-group lang-form" id="default-form">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{ translate('messages.details') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span></label>
                                    <textarea name="details[]" class="ckeditor form-control">{{$resumedetail?->getRawOriginal('details')}}</textarea>
                                </div>
                            </div>
                                @foreach(json_decode($language) as $lang)
                                
                                <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="form-group">
                                            <label class="input-label"
                                                for="{{ $lang }}_name">{{ translate('messages.degree_/_designation') }}
                                                ({{ strtoupper($lang) }})
                                            </label>
                                            <input type="text" name="title[]"
                                                class="form-control" value="{{$resumedetail?->getRawOriginal('title')}}"
                                                placeholder="{{ translate('messages.SEE_/_Web_Developer') }}">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ translate('messages.date_range') }}
                                                ({{ strtoupper($lang) }})</label>
                                            <input type="text" name="date_range[]" class="form-control" value="{{$resumedetail?->getRawOriginal('date_range')}}" placeholder="{{ translate('messages.date_range')}}">
                                        </div>
    `                                   <br>
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ translate('messages.name_/_address') }}
                                                ({{ strtoupper($lang) }})<span class="form-label-secondary text-danger"
                                                data-toggle="tooltip" data-placement="right"
                                                data-original-title="{{ translate('messages.Required.')}}"> *
                                                </span></label>
                                            <input type="text" name="name_address[]" class="form-control" value="{{$resumedetail?->getRawOriginal('name_address')}}" placeholder="{{ translate('messages.kmc_college,_bagbazar_kathmandu')}}">
                                        </div>`
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                        
                                        <br>
                                        <div class="form-group lang-form" id="default-form">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ translate('messages.details') }}
                                                ({{ strtoupper($lang) }})<span class="form-label-secondary text-danger"
                                                data-toggle="tooltip" data-placement="right"
                                                data-original-title="{{ translate('messages.Required.')}}"> *
                                                </span></label>
                                            <textarea name="details[]" class="ckeditor form-control">{{$resumedetail?->getRawOriginal('details')}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            
                            <div class="card-body">
                                <div id="default-form">
                                    
                            <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlSelect1">{{ translate('messages.resume_type') }}<span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="{{ translate('messages.Required.')}}"> *
                                            </span></label>
                                        <select name="resume_type" id="resume_type"
                                            class="form-control js-select2-custom get-request"
                                            oninvalid="this.setCustomValidity('Select Service')">
                                                <option value="" selected disabled>{{ translate('Select_resume_type') }}</option>
                                                <option value="ed" {{ $resumedetail->resume_type == 'ed' ? 'selected' : '' }}>{{ translate('Education') }}</option>
                                                <option value="ex" {{ $resumedetail->resume_type == 'ex' ? 'selected' : '' }}>{{ translate('Education') }}</option>
                                        </select>
                                </div>
                                <br>
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">{{ translate('messages.degree_/_designation') }}</label>
                                        <input type="text" name="title[]" class="form-control" value="{{$resumedetail?->getRawOriginal('title')}}" placeholder="{{ translate('messages.SEE_/_Web_Developer') }}" >
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1">{{ translate('messages.date_range') }}</label>
                                        <input type="text" name="date_range[]" class="form-control" value="{{$resumedetail?->getRawOriginal('date_range')}}" placeholder="{{ translate('messages.date_range')}}">
                                    </div>
                                    <br>
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.name_/_address') }}
                                            <span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="{{ translate('messages.Required.')}}"> *
                                            </span></label>
                                        <input type="text" name="name_address[]" class="form-control" value="{{$resumedetail?->getRawOriginal('name_address')}}" placeholder="{{ translate('messages.kmc_college,_bagbazar_kathmandu')}}">
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                    
                                    <br>
                                    <div class="form-group lang-form" id="default-form">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.details') }}
                                            <span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="{{ translate('messages.Required.')}}"> *
                                            </span></label>
                                        <textarea name="details[]" class="ckeditor form-control">{{$resumedetail?->getRawOriginal('details')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="btn--container justify-content-end">
                        <button id="reset_btn" type="button" class="btn btn--reset">{{translate('messages.reset')}}</button>
                        <button type="submit" class="btn btn--primary">{{translate('messages.update')}}</button>
                    </div>
                </form>
            </div>
            <!-- End Table -->
        </div>
    </div>

@endsection

@push('script_2')
    <script src="{{dynamicAsset('public/assets/admin/ckeditor/ckeditor.js')}}"></script>
    <script src="{{dynamicAsset('public/assets/admin')}}/js/view-pages/category-index.js"></script>
    <script>
        "use strict";
        $('#reset_btn').click(function(){
            location.reload();
        })
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileEg1").change(function () {
            readURL(this);
        });
    </script>
@endpush
