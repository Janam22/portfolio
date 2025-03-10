@extends('layouts.admin.app')
@section('title',translate('Timesheet_Details'))
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
                {{ translate('Timesheet_Details') }}
            </span>
            </h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon">
                                    <i class="tio-user"></i>
                                </span>
                                <span>
                                    {{ translate('Timesheet_Information_Details') }}
                                </span>
                            </h5>
                        </div>
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label " for="reason">{{translate('messages.Staff_Name')}}</label>
                                                <div>{{ $timesheet_details->employee->f_name }} {{ $timesheet_details->employee->l_name }}</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label " for="reason">{{translate('messages.Timesheet_Date')}}</label>
                                                <div>{{ \App\CentralLogics\Helpers::time_date_format($timesheet_details->created_at) }}</div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label " for="reason">{{translate('messages.Timesheet_Details')}}</label>
                                                <div>{{ $timesheet_details->details }}</div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">      
                                        <label class="form-label" for="reason">{{translate('messages.Supporting_Images')}}</label>                                          
                                        @php($supporting_doc = !empty($timesheet_details->supporting_images) ? json_decode($timesheet_details->supporting_images, true) : [])
                                        
                                            <div class="card-body pt-2">
                                                @if ($supporting_doc)
                                                    <label class="input-label"for="supporting_image">{{ translate('messages.image') }} : </label>
                                                    <div class="row g-3">
                                                            @foreach ($supporting_doc as $key => $img)
                                                            @php($img = is_array($img)?$img:['img'=>$img,'storage'=>'public'])
                                                                <div class="col-3">
                                                                        <img class="img__aspect-1 rounded border w-100" data-toggle="modal"  data-target="#imagemodal{{ $key }}"
                                                                        src="{{\App\CentralLogics\Helpers::get_full_url('timesheet',$img['img'],$img['storage']) }}"
                                                                        alt="image">
                                                                </div>
                                                                <div class="modal fade" id="imagemodal{{ $key }}" tabindex="-1"
                                                                    role="dialog" aria-labelledby="supporting_image_{{ $key }}"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title"
                                                                                    id="supporting_image_{{ $key }}">
                                                                                    {{ translate('Supporting_image') }}</h4>
                                                                                <button type="button" class="close"
                                                                                    data-dismiss="modal"><span
                                                                                        aria-hidden="true">&times;</span><span
                                                                                        class="sr-only">{{ translate('messages.cancel') }}</span></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <img src="{{\App\CentralLogics\Helpers::get_full_url('timesheet',$img['img'],$img['storage']) }}"
                                                                                    class="initial--22 w-100">
                                                                            </div>
                                                                            @php($storage = $img['storage'] ?? 'public')
                                                                            @php($file = $storage == 's3'?base64_encode('timesheet/' . $img['img']):base64_encode('timesheet/' . $img['img']))
                                                                            <div class="modal-footer">
                                                                                <a class="btn btn-primary"
                                                                                href="{{ route('admin.timesheet.download', [$file,$storage]) }}"><i
                                                                                        class="tio-download"></i>
                                                                                    {{ translate('messages.download') }}
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                    </div>
                                                @else
                                                    <div>Image not found.</div>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

@endsection