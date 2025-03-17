@extends('layouts.admin.app')

@section('title',translate('messages.about'))

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header_ pb-4">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title">{{translate('messages.about')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
         
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.system-settings.about')}}" method="post" id="tnc-form" enctype="multipart/form-data">
                    @csrf
                    <div class="row gx-2 gx-lg-3">

                        <div class="col-sm-12 col-lg-8 mb-3 mb-lg-2">

                                @php($language=\App\Models\SystemSetting::where('key','language')->first())
                                @php($language = $language->value ?? null)
                                @php($default_lang = str_replace('_', '-', app()->getLocale()))
                                @if ($language)
                                <ul class="nav nav-tabs mb-4 border-0">
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
                                @endif

                                <div class="form-group lang_form" id="default-form">
                                    <input type="hidden" name="lang[]" value="default">
                                    <textarea class="ckeditor form-control" name="about[]">{!! $about?->getRawOriginal('value') ?? '' !!}</textarea>
                                </div>

                                @if ($language)
                                    @forelse(json_decode($language) as $lang)
                                        <?php
                                            if($about?->translations){
                                                $translate = [];
                                                foreach($about?->translations as $t)
                                                {
                                                    if($t->locale == $lang && $t->key=="about"){
                                                        $translate[$lang]['about'] = $t->value;
                                                    }
                                                }
                                            }
                                            ?>
                                        <div class="form-group d-none lang_form" id="{{$lang}}-form">
                                            <textarea class="ckeditor form-control" name="about[]">{!!  $translate[$lang]['about'] ?? null !!}</textarea>
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{$lang}}">
                                        @empty
                                    @endforelse
                                @endif
                        </div>
                        
                        <div class="col-lg-4">
                            <div class="d-flex flex-column align-items-center gap-3">
                                <p class="mb-0">{{ translate('About image') }}</p>

                                <div class="image-box">
                                    <label for="image-input" class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer gap-2">
                                        <img class="upload-icon initial-26"
                                        src="{{\App\CentralLogics\Helpers::get_full_url('about', $about_image?->value?? '', $about_image?->storage[0]?->value ?? 'public','upload_image')}}" alt="Upload Icon">
                                        <img src="#" alt="Preview Image" class="preview-image">
                                    </label>
                                    <button type="button" class="delete_image">
                                        <i class="tio-delete"></i>
                                    </button>
                                    <input type="file" name="about_image" id="image-input" accept="image/*" hidden>
                                </div>

                                <p class="opacity-75 max-w220 mx-auto text-center">
                                    {{ translate('Image format - jpg png jpeg gif Image Size -maximum size 2 MB Image Ratio - 1:1')}}
                                </p>
                            </div>
                        </div>

                    </div>
                    
                    <div class="btn--container justify-content-end">
                        <button type="submit" class="btn btn--primary">{{translate('messages.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script src="{{dynamicAsset('public/assets/admin/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
                $('body').on('change','#data_status', function(){
                    let status;
                if(this.checked){
                 status = 1;
                }else{
                 status = 0;
                }
            let  url= '{{ url('admin/system-settings/pages/about') }}/'+status;
            $.ajax({
                url: url,
                method: 'get',
                success: function() {
                    toastr.success('{{ translate('messages.status_updated!') }}', {
                    CloseButton: true,
                    ProgressBar: true
                    });
                }
            });

            });
        });
</script>

@endpush
