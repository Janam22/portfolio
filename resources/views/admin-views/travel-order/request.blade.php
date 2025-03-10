@extends('layouts.admin.app')
@section('title',translate('New_Travel_Order_Request'))
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
                {{ translate('Add_New_Travel_Order_Request') }}
            </span>
            </h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <form action="{{route('admin.travel-order-request.store')}}" method="post"  class="js-validate" enctype="multipart/form-data">
                    @csrf
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title">
                                <span class="card-header-icon">
                                    <i class="tio-user"></i>
                                </span>
                                <span>
                                    {{ translate('Travel_Order_Information') }}
                                </span>
                            </h5>
                        </div>
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-group mb-0">
                                                <label class="form-label " for="from_date">{{translate('messages.Start_date')}}</label>
                                                <input type="date" name="from_date" class="form-control h--45px" id="from_date" value="{{old('from_date')}}" placeholder="{{ translate('Ex:_travel_order_starting_date') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-0">
                                                <label class="form-label " for="to_date">{{translate('messages.End_date')}}</label>
                                                <input type="date" name="to_date" class="form-control h--45px" id="to_date" value="{{old('to_date')}}" placeholder="{{ translate('Ex:_travel_order_ending_date') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group mb-0">
                                                <label class="form-label " for="travel_place">{{translate('messages.Travel_Place')}}</label>
                                                <input type="text" name="travel_place" class="form-control h--45px" id="travel_place" value="{{old('travel_place')}}" placeholder="{{ translate('Ex:_pokhara') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-label " for="travel_mode">{{translate('messages.means_of_transportation')}}</label>
                                                <input name="travel_mode" value="{{old('travel_mode')}}" class="form-control" id="travel_mode" placeholder="{{ translate('Ex:_Bus') }}" required>
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
