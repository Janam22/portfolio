@extends('layouts.admin.app')

@section('title',translate('messages.Add_New_Resume_Details'))

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
                            <img src="{{dynamicAsset('public/assets/admin/img/category.png')}}" alt="">
                        </div>
                        <span>
                            {{translate('Resume_Details')}}
                        </span>
                    </h2>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <div class="card resturant--cate-form">
            <div class="card-body">
                <form action="{{route('admin.resumedetail.store')}}" method="post" enctype="multipart/form-data">
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
                                                <option value="ed">{{ translate('Education') }}</option>
                                                <option value="ex">{{ translate('Experience') }}</option>
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
                                        class="form-control"
                                        placeholder="{{ translate('messages.SEE_/_Web_Developer') }}">
                                </div>
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{ translate('messages.date_range') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span></label>
                                    <input type="text" name="date_range[]" class="form-control" placeholder="{{ translate('messages.2022_-_2025')}}">
                                </div>
                                <br>
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{ translate('messages.name_/_address') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span></label>
                                    <input type="text" name="name_address[]" class="form-control" placeholder="{{ translate('messages.kmc_college,_bagbazar_kathmandu')}}">
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
                                    <textarea name="details[]" class="ckeditor form-control"></textarea>
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
                                                class="form-control"
                                                placeholder="{{ translate('messages.SEE_/_Web_Developer') }}">
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ translate('messages.date_range') }}
                                                ({{ strtoupper($lang) }})</label>
                                            <input type="text" name="date_range[]" class="form-control" placeholder="{{ translate('messages.date_range')}}">
                                        </div>
    `                                   <br>
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ translate('messages.name_/_address') }}
                                                ({{ strtoupper($lang) }})<span class="form-label-secondary text-danger"
                                                data-toggle="tooltip" data-placement="right"
                                                data-original-title="{{ translate('messages.Required.')}}"> *
                                                </span></label>
                                            <input type="text" name="name_address[]" class="form-control" placeholder="{{ translate('messages.kmc_college,_bagbazar_kathmandu')}}">
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
                                            <textarea name="details[]" class="ckeditor form-control"></textarea>
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
                                                <option value="ed">{{ translate('Education') }}</option>
                                                <option value="ex">{{ translate('Education') }}</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">{{ translate('messages.degree_/_designation') }}</label>
                                        <input type="text" name="title[]" class="form-control" placeholder="{{ translate('messages.SEE_/_Web_Developer') }}" >
                                    </div>
                                    <div class="form-group mb-0">
                                        <label class="input-label" for="exampleFormControlInput1">{{ translate('messages.date_range') }}</label>
                                        <input type="text" name="date_range[]" class="form-control" placeholder="{{ translate('messages.date_range')}}">
                                    </div>
                                    <br>
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.name_/_address') }}
                                            <span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="{{ translate('messages.Required.')}}"> *
                                            </span></label>
                                        <input type="text" name="name_address[]" class="form-control" placeholder="{{ translate('messages.kmc_college,_bagbazar_kathmandu')}}">
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
                                        <textarea name="details[]" class="ckeditor form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <div class="form-group pt-2 mb-0">
                                <div class="btn--container justify-content-end">
                                    <!-- Static Button -->
                                    <button id="reset_btn" type="reset" class="btn btn--reset">{{translate('messages.reset')}}</button>
                                    <!-- Static Button -->
                                    <button type="submit" class="btn btn--primary">{{ translate('messages.submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="card-header py-2">
                <div class="search--button-wrapper">
                    <h5 class="card-title"><span class="card-header-icon">
                        <i class="tio-category-outlined"></i>
                    </span> {{translate('messages.resume_details_list')}}<span class="badge badge-soft-dark ml-2" id="itemCount">{{$resumedetails->total()}}</span></h5>
                    <form>

                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input type="search" name="search" value="{{ request()?->search ?? null }}"  class="form-control" placeholder="{{ translate('Ex_:_title') }}" aria-label="{{translate('messages.search_resume_details')}}">
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                        </div>
                        <!-- End Search -->
                    </form>

                </div>
            </div>
            <div class="table-responsive datatable-custom">
                <table id="columnSearchDatatable"
                    class="table table-borderless table-thead-bordered table-align-middle"
                    data-hs-datatables-options='{
                        "isResponsive": false,
                        "isShowPaging": false,
                        "paging":false,
                    }'>
                    <thead class="thead-light">
                        <tr>
                            <th>{{ translate('messages.SL') }}</th>
                            <th>{{ translate('messages.resume_type') }}</th>
                            <th>{{translate('messages.title')}}</th>
                            <th>{{translate('messages.Date Range')}}</th>
                            <th>{{translate('messages.Name_/_Address')}}</th>
                            <th>{{translate('messages.details')}}</th>
                            <th>{{translate('messages.status')}}</th>
                            <th class="text-cetner w-130px">{{translate('messages.action')}}</th>
                        </tr>
                    </thead>

                    <tbody id="table-div">
                    @foreach($resumedetails as $key=>$resumedetail)
                        <tr>
                            <td>
                                <div class="pl-3">
                                    {{$key+$resumedetails->firstItem()}}
                                </div>
                            </td>
                            <td>
                                @if($resumedetail->resume_type == 'ed')
                                    Education
                                @elseif($resumedetail->resume_type == 'ex')
                                    Experience
                                @endif
                            </td>
                            <td>
                                {{ $resumedetail['title'] }}
                            </td>
                            <td>
                                {{ $resumedetail['date_range'] }}
                            </td>
                            <td>
                                {{ $resumedetail['name_address'] }}
                            </td>
                            <td>
                                {{ $resumedetail['details'] }}
                            </td>
                            <td>
                                <label class="toggle-switch toggle-switch-sm ml-2" for="stocksCheckbox{{$resumedetail->id}}">
                                <input type="checkbox" data-url="{{route('admin.resumedetail.status',[$resumedetail['id'],$resumedetail->status?0:1])}}" class="toggle-switch-input redirect-url" id="stocksCheckbox{{$resumedetail->id}}" {{$resumedetail->status?'checked':''}}>
                                    <span class="toggle-switch-label">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                            <td>
                                <div class="btn--container">
                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                        href="{{route('admin.resumedetail.edit',[$resumedetail['id']])}}" title="{{translate('messages.edit_resumedetail')}}"><i class="tio-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert" href="javascript:"
                                    data-id="resumedetail-{{$resumedetail['id']}}" data-message="{{ translate('Want_to_delete_this_resumedetail_?') }}" title="{{translate('messages.delete_resumedetail')}}"><i class="tio-delete-outlined"></i>
                                    </a>
                                </div>

                                <form action="{{route('admin.resumedetail.delete',[$resumedetail['id']])}}" method="post" id="resumedetail-{{$resumedetail['id']}}">
                                    @csrf @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if(count($resumedetails) === 0)
                <div class="empty--data">
                    <img src="{{dynamicAsset('/public/assets/admin/img/empty.png')}}" alt="public">
                    <h5>
                        {{translate('no_data_found')}}
                    </h5>
                </div>
                @endif
            </div>
            <div class="card-footer pt-0 border-0">
                <div class="page-area px-4 pb-3">
                    <div class="d-flex align-items-center justify-content-end">
                        <div>
                            {!! $resumedetails->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script src="{{dynamicAsset('public/assets/admin/ckeditor/ckeditor.js')}}"></script>
    <script src="{{dynamicAsset('public/assets/admin')}}/js/view-pages/category-index.js"></script>
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

        $("#customFileEg1").change(function () {
            readURL(this);
        });
        $('#reset_btn').on('click',function (){

            $('.preview-image').attr('src', "{{dynamicAsset('public/assets/admin/img/aspect-1.png')}}");
            $('#image').val(null);
    });
    </script>
@endpush
