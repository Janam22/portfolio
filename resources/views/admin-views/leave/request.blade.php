@extends('layouts.admin.app')
@section('title',translate('New_Leave_Request'))
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
                {{ translate('Add_New_Leave_Request') }}
            </span>
            </h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('admin.leave-request.store')}}" method="post"  class="js-validate" enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon">
                                    <i class="tio-user"></i>
                                </span>
                                <span>
                                    {{ translate('Leave_Information') }}
                                </span>
                            </h5>
                        </div>
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <div class="form-group mb-0">
                                                <label class="form-label " for="fname">{{translate('messages.leave_type')}}</label>
                                                <select class="w-100 form-control h--45px js-select2-custom" name="leave_type" id="leave_type" required>
                                                    <option value="" selected disabled>{{translate('messages.select_leave')}}</option>
                                                    <option value="sl">Sick Leave</option>
                                                    <option value="el">Emergency Leave</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-0">
                                                <label class="form-label " for="from_date">{{translate('messages.Start_date')}}</label>
                                                <input type="date" name="from_date" class="form-control h--45px" id="from_date" value="{{old('from_date')}}" placeholder="{{ translate('Ex:_leave_starting_date') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group mb-0">
                                                <label class="form-label " for="to_date">{{translate('messages.End_date')}}</label>
                                                <input type="date" name="to_date" class="form-control h--45px" id="to_date" value="{{old('to_date')}}" placeholder="{{ translate('Ex:_leave_ending_date') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-0">
                                                <label class="form-label " for="subject">{{translate('messages.Subject')}}</label>
                                                <input type="text" name="subject" class="form-control h--45px" id="subject" value="{{old('subject')}}" placeholder="{{ translate('Ex:_subject') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label " for="reason">{{translate('messages.reason_description')}}</label>
                                                <textarea name="reason" rows="4 " cols="50" value="{{old('reason')}}" class="form-control" id="reason"
                                                       placeholder="{{ translate('Ex:_reason_description') }}" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn--container justify-content-end">
                        <!-- Static Button -->
                        <button type="reset" id="reset_btn" class="btn btn--reset">{{translate('messages.reset')}}</button>
                        <!-- Static Button -->
                        <button type="submit" class="btn btn--primary">{{translate('messages.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script_2')
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
