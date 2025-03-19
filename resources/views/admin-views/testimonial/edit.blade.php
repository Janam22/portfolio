@extends('layouts.admin.app')

@section('title',translate('messages.Update_testimonial'))

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
                            {{translate('messages.testimonial_Update')}}
                        </span>
                    </h2>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.testimonial.update',[$testimonial['id']])}}" method="post" enctype="multipart/form-data">
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
                        <div class="col-lg-6">
                        @if ($language)
                            <div class="lang_form" id="default-form">

                                <div class="form-group">
                                    <label class="input-label"
                                        for="default_name">{{ translate('messages.name') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span>
                                    </label>
                                    <input type="text" name="name[]" id="default_name"
                                        class="form-control" value="{{$testimonial?->getRawOriginal('name')}}"
                                        placeholder="{{ translate('messages.name') }}">
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{ translate('messages.designation') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span></label>
                                    <input type="text" name="designation[]" class="form-control" placeholder="{{ translate('messages.designation') }}" value="{{$testimonial?->getRawOriginal('designation')}}">
                                </div>
                                <br>
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{ translate('messages.message') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span></label>
                                    <textarea type="text" name="message[]" class="form-control ckeditor min-height-154px">{!! $testimonial?->getRawOriginal('message') ?? '' !!}</textarea>
                                </div>
                            </div>
                                @foreach(json_decode($language) as $lang)
                                
                                <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="form-group">
                                            <label class="input-label"
                                                for="{{ $lang }}_name">{{ translate('messages.name') }}
                                                ({{ strtoupper($lang) }})
                                            </label>
                                            <input type="text" name="name[]" id="{{ $lang }}_name"
                                                class="form-control" value="{{$testimonial?->getRawOriginal('name')}}"
                                                placeholder="{{ translate('messages.name') }}">
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ translate('designation') }}
                                                ({{ strtoupper($lang) }})</label>
                                            <input type="text" name="designation[]" class="form-control" placeholder="{{ translate('designation') }}" value="{{$testimonial?->getRawOriginal('designation')}}">
                                        </div>
                                        <br>
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ translate('messages.message') }}
                                                ({{ strtoupper($lang) }})</label>
                                            <textarea type="text" name="message[]" class="form-control ckeditor min-height-154px">{!! $message?->getRawOriginal('message') ?? '' !!}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            
                            <div class="card-body">
                                <div id="default-form">
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.name') }}
                                            ({{ translate('Default') }})</label>
                                        <input type="text" name="name[]" class="form-control" value="{{$testimonial?->getRawOriginal('name')}}"
                                            placeholder="{{ translate('messages.name') }}" >
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.designation') }}</label>
                                        <input type="text" name="designation[]" class="form-control" placeholder="{{ translate('messages.designation') }}" value="{{$testimonial?->getRawOriginal('designation')}}">
                                    </div>
                                    <br>
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.message') }}</label>
                                        <textarea type="text" name="message[]" class="form-control ckeditor min-height-154px">{!! $testimonial?->getRawOriginal('message') ?? '' !!}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endif

                    </div>

                        <div class="col-lg-6">

                            <div class="d-flex flex-column align-items-center gap-3">
                                <p class="mb-0">{{ translate('Person image') }}</p>

                                <div class="image-box">
                                    <label for="image-input" class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer gap-2">
                                        <img class="upload-icon initial-26"
                                        src="{{$testimonial['image_full_url'] }}" alt="Upload Icon">
                                        <img src="#" alt="Preview Image" class="preview-image">
                                    </label>
                                    <button type="button" class="delete_image">
                                        <i class="tio-delete"></i>
                                    </button>
                                    <input type="file" name="image" id="image-input" accept="image/*" hidden>
                                </div>

                                <p class="opacity-75 max-w220 mx-auto text-center">
                                    {{ translate('Image format - jpg png jpeg gif Image Size -maximum size 2 MB Image Ratio - 1:1')}}
                                </p>
                            </div>


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
