@extends('layouts.admin.app')

@section('title',translate('messages.Add_New_Project'))

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
                            {{translate('Project')}}
                        </span>
                    </h2>
                </div>
                @if(isset($category))
                <a href="{{route('admin.project.add')}}" class="btn btn--primary pull-right"><i class="tio-add-circle"></i> {{translate('messages.Add_New_Project')}}</a>
                @endif
            </div>
        </div>
        <!-- End Page Header -->

        <div class="card resturant--cate-form">
            <div class="card-body">
                <form action="{{isset($project)?route('admin.project.update',[$project['id']]):route('admin.project.store')}}" method="post" enctype="multipart/form-data">
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
                                        for="default_name">{{ translate('messages.project_name') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span>
                                    </label>
                                    <input type="text" name="name[]" id="default_name"
                                        class="form-control"
                                        placeholder="{{ translate('messages.new_project') }}">
                                </div>
                                <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlSelect1">{{ translate('messages.service') }}<span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="{{ translate('messages.Required.')}}"> *
                                            </span></label>
                                        <select name="service_id" id="service_id"
                                            class="form-control js-select2-custom get-request"
                                            oninvalid="this.setCustomValidity('Select Service')">
                                            <option value="" selected disabled>
                                                {{ translate('Select_Service') }}</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service['id'] }}">{{ $service['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                                <br>
                                <input type="hidden" name="lang[]" value="default">
                                <div class="form-group mb-0">
                                    <label class="input-label"
                                        for="exampleFormControlInput1">{{ translate('messages.description') }}
                                        ({{ translate('Default') }}) <span class="form-label-secondary text-danger"
                                        data-toggle="tooltip" data-placement="right"
                                        data-original-title="{{ translate('messages.Required.')}}"> *
                                        </span></label>
                                    <textarea type="text" name="description[]" class="form-control ckeditor min-height-100px"></textarea>
                                </div>
                                <br>
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{ translate('messages.project_link_(optional)') }}</label>
                                    <input type="text" name="link" class="form-control"
                                        placeholder="{{ translate('messages.project_link') }}" >
                                </div>
                            </div>
                                @foreach(json_decode($language) as $lang)
                                
                                <div class="d-none lang_form" id="{{ $lang }}-form">
                                        <div class="form-group">
                                            <label class="input-label"
                                                for="{{ $lang }}_name">{{ translate('messages.project name') }}
                                                ({{ strtoupper($lang) }})
                                            </label>
                                            <input type="text" name="name[]" id="{{ $lang }}_name"
                                                class="form-control"
                                                placeholder="{{ translate('messages.new_project') }}"
                                                 >
                                        </div>
                                        <input type="hidden" name="lang[]" value="{{ $lang }}">
                                        <div class="form-group mb-0">
                                            <label class="input-label"
                                                for="exampleFormControlInput1">{{ translate('messages.description') }}
                                                ({{ strtoupper($lang) }})</label>
                                            <textarea type="text" name="description[]" class="form-control ckeditor min-height-100px"></textarea>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                            
                            <div class="card-body">
                                <div id="default-form">
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.project_name') }}
                                            ({{ translate('Default') }})</label>
                                        <input type="text" name="name[]" class="form-control"
                                            placeholder="{{ translate('messages.new_project') }}" >
                                    </div>
                                <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlSelect1">{{ translate('messages.service') }}<span class="form-label-secondary text-danger"
                                            data-toggle="tooltip" data-placement="right"
                                            data-original-title="{{ translate('messages.Required.')}}"> *
                                            </span></label>
                                        <select name="service_id" id="service_id"
                                            class="form-control js-select2-custom get-request"
                                            oninvalid="this.setCustomValidity('Select Service')">
                                            <option value="" selected disabled>
                                                {{ translate('Select_Service') }}</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service['id'] }}">{{ $service['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                </div>
                                <br>
                                    <input type="hidden" name="lang[]" value="default">
                                    <div class="form-group mb-0">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.description') }}</label>
                                        <textarea type="text" name="description[]" class="form-control ckeditor min-height-100px"></textarea>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <label class="input-label"
                                            for="exampleFormControlInput1">{{ translate('messages.project_link_(optional)') }}
                                            ({{ translate('Default') }})</label>
                                        <input type="text" name="link" class="form-control"
                                            placeholder="{{ translate('messages.project_link') }}" >
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column align-items-center gap-3">
                                <p class="mb-0">{{ translate('Project image') }}</p>

                                <div class="image-box">
                                    <label for="image-input" class="d-flex flex-column align-items-center justify-content-center h-100 cursor-pointer gap-2">
                                        <img class="upload-icon initial-10"
                                        src="{{dynamicAsset('public/assets/admin/img/upload-icon.png')}}" alt="Upload Icon">
                                        <span class="upload-text">{{ translate('Upload Image')}}</span>
                                        <img src="#" alt="Preview Image" class="preview-image">
                                    </label>
                                    <button type="button" class="delete_image">
                                        <i class="tio-delete"></i>
                                    </button>
                                    <input type="file" id="image-input" name="image" accept="image/*" hidden>
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

        <div class="card mt-3">
            <div class="card-header py-2">
                <div class="search--button-wrapper">
                    <h5 class="card-title"><span class="card-header-icon">
                        <i class="tio-category-outlined"></i>
                    </span> {{translate('messages.project_list')}}<span class="badge badge-soft-dark ml-2" id="itemCount">{{$projects->total()}}</span></h5>
                    <form>

                        <!-- Search -->
                        <div class="input--group input-group input-group-merge input-group-flush">
                            <input type="search" name="search" value="{{ request()?->search ?? null }}"  class="form-control" placeholder="{{ translate('Ex_:_Projects') }}" aria-label="{{translate('messages.search_projects')}}">
                            <button type="submit" class="btn btn--secondary"><i class="tio-search"></i></button>
                        </div>
                        <!-- End Search -->
                    </form>

                    <div class="hs-unfold ml-3">
                        <a class="js-hs-unfold-invoker btn btn-sm btn-white dropdown-toggle btn export-btn btn-outline-primary btn--primary font--sm" href="javascript:;"
                            data-hs-unfold-options='{
                                "target": "#usersExportDropdown",
                                "type": "css-animation"
                            }'>
                            <i class="tio-download-to mr-1"></i> {{translate('messages.export')}}
                        </a>

                        <div id="usersExportDropdown"
                                class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
                            <span class="dropdown-header">{{translate('messages.download_options')}}</span>
                            <a target="__blank" id="export-excel" class="dropdown-item" href="{{route('admin.project.export-projects', ['type'=>'excel', request()->getQueryString()])}}">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="{{dynamicAsset('public/assets/admin')}}/svg/components/excel.svg"
                                        alt="Image Description">
                                {{translate('messages.excel')}}
                            </a>
                            <a target="__blank" id="export-csv" class="dropdown-item" href="{{route('admin.project.export-projects', ['type'=>'csv', request()->getQueryString()])}}">
                                <img class="avatar avatar-xss avatar-4by3 mr-2"
                                        src="{{dynamicAsset('public/assets/admin')}}/svg/components/placeholder-csv-format.svg"
                                        alt="Image Description">
                                {{translate('messages.csv')}}
                            </a>
                        </div>
                    </div>
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
                            <th>{{ translate('messages.image') }}</th>
                            <th>{{translate('messages.name')}}</th>
                            <th>{{translate('messages.description')}}</th>
                            <th>{{translate('messages.link')}}</th>
                            <th>
                                <div class="ml-3">
                                    {{translate('messages.priority')}}
                                </div>
                            </th>
                            <th>{{translate('messages.status')}}</th>
                            <th class="text-cetner w-130px">{{translate('messages.action')}}</th>
                        </tr>
                    </thead>

                    <tbody id="table-div">
                    @foreach($projects as $key=>$project)
                        <tr>
                            <td>
                                <div class="pl-3">
                                    {{$key+$projects->firstItem()}}
                                </div>
                            </td>
                            <td>
                                <div class="">
                                    <img class="avatar border"

                                    src="{{ $project['image_full_url'] }}"


                                  alt="{{Str::limit($project['name'], 20,'...')}}">
                                </div>
                            </td>
                            <td>
                                <div class="d-block font-size-sm text-body">
                                    <div>{{Str::limit($project['name'], 20,'...')}}</div>
                                    <div class="font-weight-bold">{{translate('ID')}} #{{$project->id}}</div>
                                </div>
                            </td>
                            <td>
                                <div class="d-block font-size-sm text-body">
                                    <div>{{ $project['description'] }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="d-block font-size-sm text-body">
                                    <div>{{ $project['link'] }}</div>
                                </div>
                            </td>
                            <td>
                                <form action="{{route('admin.project.priority',$project->id)}}" class="priority-form">
                                <select name="priority" id="priority" class=" form-control form--control-select priority-select {{$project->priority == 0 ? 'text--title':''}} {{$project->priority == 1 ? 'text--info':''}} {{$project->priority == 2 ? 'text--success':''}} ">
                                    <option class="text--title" value="0" {{$project->priority == 0?'selected':''}}>{{translate('messages.normal')}}</option>
                                    <option class="text--info" value="1" {{$project->priority == 1?'selected':''}}>{{translate('messages.medium')}}</option>
                                    <option class="text--success" value="2" {{$project->priority == 2?'selected':''}}>{{translate('messages.high')}}</option>
                                </select>
                                </form>
                            </td>
                            <td>
                                <label class="toggle-switch toggle-switch-sm ml-2" for="stocksCheckbox{{$project->id}}">
                                <input type="checkbox" data-url="{{route('admin.project.status',[$project['id'],$project->status?0:1])}}" class="toggle-switch-input redirect-url" id="stocksCheckbox{{$project->id}}" {{$project->status?'checked':''}}>
                                    <span class="toggle-switch-label">
                                        <span class="toggle-switch-indicator"></span>
                                    </span>
                                </label>
                            </td>
                            <td>
                                <div class="btn--container">
                                    <a class="btn btn-sm btn--primary btn-outline-primary action-btn"
                                        href="{{route('admin.project.edit',[$project['id']])}}" title="{{translate('messages.edit_project')}}"><i class="tio-edit"></i>
                                    </a>
                                    <a class="btn btn-sm btn--danger btn-outline-danger action-btn form-alert" href="javascript:"
                                    data-id="category-{{$project['id']}}" data-message="{{ translate('Want_to_delete_this_project_?') }}" title="{{translate('messages.delete_project')}}"><i class="tio-delete-outlined"></i>
                                    </a>
                                </div>

                                <form action="{{route('admin.project.delete',[$project['id']])}}" method="post" id="project-{{$project['id']}}">
                                    @csrf @method('delete')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if(count($projects) === 0)
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
                            {!! $projects->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
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
