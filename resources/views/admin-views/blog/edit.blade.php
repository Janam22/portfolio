@extends('layouts.admin.app')
@section('title',translate('Edit_Blog'))
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Heading -->
        <div class="page-header">
            <h1 class="page-header-title mb-2 text-capitalize">
                <div class="card-header-icon d-inline-flex mr-2 img">
                    <img src="{{dynamicAsset('/public/assets/admin/img/employee.png')}}" alt="public">
                </div>
                <span>
                {{ translate('Update_Blog') }}
            </span>
            </h1>
        </div>

        <div class="card resturant--cate-form">
            <div class="card-body">
                <form action="{{route('admin.blog.update',[$blog['id']])}}" method="post" enctype="multipart/form-data">
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
                        <div class="col-lg-8">
                            @if ($language)
                            <div class="lang_form" id="default-form">

                                <div class="form-group">
                                    <label class="input-label"
                                        for="default_name">{{ translate('messages.author_name') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span>
                                    </label>
                                    <input type="text" name="author_name[]"
                                        class="form-control" value="{{$blog?->getRawOriginal('author_name')}}"
                                        placeholder="{{ translate('messages.author_name') }}">
                                </div>
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{ translate('messages.blog_title') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span></label>
                                    <input type="text" name="blog_title[]" value="{{$blog?->getRawOriginal('blog_title')}}" class="form-control" placeholder="{{ translate('messages.blog_title')}}">
                                </div>
                                <input type="hidden" name="lang[]" value="default">
                                <br>
                                <div class="form-group lang-form" id="default-form">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{ translate('messages.blog_details') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span></label>
                                    <textarea name="blog_details[]" class="ckeditor form-control">{{$blog?->getRawOriginal('blog_details')}}</textarea>
                                </div>
                            </div>
                                @foreach(json_decode($language) as $lang)
                                
                                <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="form-group">
                                            <label class="input-label"
                                                for="{{ $lang }}_name">{{ translate('messages.author_name') }}
                                                ({{ strtoupper($lang) }})
                                            </label>
                                            <input type="text" name="author_name[]"
                                                class="form-control"
                                                placeholder="{{ translate('messages.author_name') }}"
                                                 >
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ translate('messages.blog_title') }}
                                                ({{ strtoupper($lang) }})</label>
                                            <input type="text" name="blog_title[]" class="form-control" placeholder="{{ translate('messages.blog_title')}}">
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                        
                                        <br>
                                        <div class="form-group lang-form" id="default-form">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ translate('messages.blog_details') }}
                                                ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                                data-toggle="tooltip" data-placement="right"
                                                data-original-title="{{ translate('messages.Required.')}}"> *
                                                </span></label>
                                            <textarea name="blog_details[]" class="ckeditor form-control"></textarea>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            
                            <div class="card-body">
                                <div id="default-form">
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">{{ translate('messages.author_name') }} ({{ translate('Default') }})</label>
                                        <input type="text" name="author_name[]" class="form-control" placeholder="{{ translate('messages.author_name') }}" >
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1">{{ translate('messages.blog_title') }}</label>
                                        <input type="text" name="blog_title[]" class="form-control" placeholder="{{ translate('messages.blog_title')}}">
                                    </div>
                                    <input type="hidden" name="lang[]" value="default">
                                    
                                    <br>
                                    <div class="form-group lang-form" id="default-form">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.blog_details') }}
                                            ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="{{ translate('messages.Required.')}}"> *
                                            </span></label>
                                        <textarea name="blog_details[]" class="ckeditor form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-4">
                            <div class="d-flex flex-column align-items-center gap-3">
                                <p class="mb-0">{{ translate('Blog image') }}</p>

                                <div class="image-box">
                                    <label for="image-input" class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer gap-2">
                                        <img class="upload-icon initial-10"
                                        src="{{$blog['image_full_url'] }}" alt="Upload Icon">
                                        <span class="upload-text">{{ translate('Upload Image')}}</span>
                                        <img src="#" alt="Preview Image" class="preview-image">
                                    </label>
                                    <button type="button" class="delete_image">
                                        <i class="tio-delete"></i>
                                    </button>
                                    <input type="file" id="image-input" name="blog_image" accept="image/*" hidden>
                                </div>

                                <p class="opacity-75 max-w220 mx-auto text-center">
                                    {{ translate('Image format - jpg png jpeg gif Image Size -maximum size 2 MB Image Ratio - 1:1')}}
                                </p>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group pt-2 mb-0">
                                <div class="btn--container justify-content-end">
                                    <!-- Static Button -->
                                    <button id="reset_btn" type="reset" class="btn btn--reset">{{translate('messages.reset')}}</button>
                                    <!-- Static Button -->
                                    <button type="submit" class="btn btn--primary">{{isset($category)?translate('messages.update'):translate('messages.submit')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
    <script src="{{dynamicAsset('public/assets/admin/ckeditor/ckeditor.js')}}"></script>
    <script>
        "use strict";
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function () {
            readURL(this);
        });

        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });


        $('#reset_btn').on('click',function (){

            $('.preview-image').attr('src', "{{dynamicAsset('public/assets/admin/img/aspect-1.png')}}");
            $('#image').val(null);
        });
    </script>
@endpush
