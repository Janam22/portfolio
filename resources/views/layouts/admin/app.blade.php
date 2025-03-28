<!DOCTYPE html>
    <?php
        $site_direction = session()->get('site_direction');
        $country=\App\Models\SystemSetting::where('key','country')->first();
        $countryCode= strtolower($country?$country->value:'auto');
    ?>

<html dir="{{ $site_direction }}" lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $site_direction === 'rtl'?'active':'' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>@yield('title')</title>
    <!-- Favicon -->
    @php($logo = \App\Models\SystemSetting::where(['key' => 'icon'])->first()->value)
    <link rel="shortcut icon" href="">
    <link rel="icon" type="image/x-icon" href="{{ dynamicStorage('storage/app/public/business/' . $logo ?? '') }}">
    <!-- Font -->
    <link href="{{dynamicAsset('public/assets/admin/css/fonts.css')}}" rel="stylesheet">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/vendor.min.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/vendor/icon-set/style.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/custom.css') }}">
    <!-- CSS Front Template -->
    <link  rel="stylesheet" href="{{dynamicAsset('/public/assets/admin/plugins/lightbox/css/lightbox.css')}}">

    <link rel="stylesheet" href="{{dynamicAsset('public/assets/admin/css/owl.min.css')}}">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/emojionearea.min.css') }}">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/theme.minc619.css?v=1.0') }}">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{dynamicAsset('public/assets/admin/intltelinput/css/intlTelInput.css')}}">
    @stack('css_or_js')
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/toastr.css') }}">
</head>

<body class="footer-offset">

    @if(env('APP_MODE')=='demo')
    <div id="direction-toggle" class="direction-toggle">
        <i class="tio-settings"></i>
        <span></span>
    </div>
    @endif
    <div id="pre--loader" class="pre--loader">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="loading" class="initial-hidden">
                    <div class="loading--1">
                        <img width="200" src="{{ dynamicAsset('public/assets/admin/img/loader.gif') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Builder -->
    @include('layouts.admin.partials._front-settings')
    <!-- End Builder -->

    <!-- JS Preview mode only -->
    @include('layouts.admin.partials._header')
    @include('layouts.admin.partials._sidebar')
    <!-- END ONLY DEV -->

    <main id="content" role="main" class="main pointer-event">
        <!-- Content -->
        @yield('content')
        <!-- End Content -->

        <!-- Footer -->
        @include('layouts.admin.partials._footer')
        <!-- End Footer -->


        <div class="modal fade" id="toggle-modal">
            <div class="modal-dialog status-warning-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true" class="tio-clear"></span>
                        </button>
                    </div>
                    <div class="modal-body pb-5 pt-0">
                        <div class="max-349 mx-auto mb-20">
                            <div>
                                <div class="text-center">
                                    <img id="toggle-image" alt="" class="mb-20">
                                    <h5 class="modal-title" id="toggle-title"></h5>
                                </div>
                                <div class="text-center" id="toggle-message">
                                </div>
                            </div>
                            <div class="btn--container justify-content-center">
                                <button type="button" id="toggle-ok-button" class="btn btn--primary min-w-120 confirm-Toggle" data-dismiss="modal">{{translate('Ok')}}</button>
                                <button id="reset_btn" type="reset" class="btn btn--cancel min-w-120" data-dismiss="modal">
                                    {{translate("Cancel")}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="toggle-status-modal">
            <div class="modal-dialog status-warning-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true" class="tio-clear"></span>
                        </button>
                    </div>
                    <div class="modal-body pb-5 pt-0">
                        <div class="max-349 mx-auto mb-20">
                            <div>
                                <div class="text-center">
                                    <img id="toggle-status-image" alt="" class="mb-20">
                                    <h5 class="modal-title" id="toggle-status-title"></h5>
                                </div>
                                <div class="text-center" id="toggle-status-message">
                                </div>
                            </div>
                            <div class="btn--container justify-content-center">
                                <button type="button" id="toggle-status-ok-button" class="btn btn--primary min-w-120 confirm-Status-Toggle" data-dismiss="modal">{{translate('Ok')}}</button>
                                <button id="reset_btn" type="reset" class="btn btn--cancel min-w-120" data-dismiss="modal">
                                    {{translate("Cancel")}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="new-dynamic-submit-model">
            <div class="modal-dialog modal-dialog-centered status-warning-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true" class="tio-clear"></span>
                        </button>
                    </div>
                    <div class="modal-body pb-5 pt-0">
                        <div class="max-349 mx-auto mb-20">
                            <div>
                                <div class="text-center">
                                    <img id="image-src" class="mb-20">
                                    <h5 class="modal-title" id="toggle-title"></h5>
                                </div>
                                <div class="text-center" id="toggle-message">
                                    <h3 id="modal-title"></h3>
                                    <div id="modal-text"></div>
                                </div>

                                </div>
                                <div class="mb-4 d-none" id="note-data">
                                    <textarea class="form-control" placeholder="{{ translate('your_note_here') }}" id="get-text-note" cols="5" ></textarea>
                                </div>
                            <div class="btn--container justify-content-center">
                                <div id="hide-buttons">
                                    <button data-dismiss="modal" id="cancel_btn_text" class="btn btn-outline-secondary min-w-120" >{{translate("Not_Now")}}</button> &nbsp;
                                    <button type="button" id="new-dynamic-ok-button" class="btn btn-outline-danger confirm-model min-w-120">{{translate('Yes')}}</button>
                                </div>

                                <button data-dismiss="modal"  type="button" id="new-dynamic-ok-button-show" class="btn btn--primary  d-none min-w-120">{{translate('Okay')}}</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- ========== END MAIN CONTENT ========== -->

   <!-- ========== END SECONDARY CONTENTS ========== -->
   <script src="{{ dynamicAsset('public/assets/admin/js/custom.js') }}"></script>
   <!-- JS Implementing Plugins -->
   <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="{{dynamicAsset('public/assets/admin/js/jquery.min.js')}}"></script>

    <script>
            "use strict";
    setTimeout(hide_loader, 1000);
    function hide_loader(){
        $('#pre--loader').removeClass("pre--loader");;
    }

    </script>
    <script src="{{dynamicAsset('public/assets/admin/js/firebase.min.js')}}"></script>

   @stack('script')
   <!-- JS Front -->
   <script src="{{ dynamicAsset('public/assets/admin/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js') }}"></script>
   <script src="{{ dynamicAsset('public/assets/admin/js/vendor.min.js') }}"></script>
   <script src="{{ dynamicAsset('public/assets/admin/js/theme.min.js') }}"></script>
   <script src="{{ dynamicAsset('public/assets/admin/js/sweet_alert.js') }}"></script>
   <script src="{{ dynamicAsset('public/assets/admin/js/toastr.js') }}"></script>
   <script src="{{dynamicAsset('public/assets/admin/js/owl.min.js')}}"></script>
   <script src="{{dynamicAsset('public/assets/admin/intltelinput/js/intlTelInput.min.js')}}"></script>

    <script src="{{ dynamicAsset('/public/assets/admin/plugins/lightbox/js/lightbox.min.js')}}"></script>

   <script>
    "use strict";

       $('.blinkings').on('mouseover', ()=> $('.blinkings').removeClass('active'))
       $('.blinkings').addClass('open-shadow')
       setTimeout(() => {
           $('.blinkings').removeClass('active')
       }, 10000);
       setTimeout(() => {
           $('.blinkings').removeClass('open-shadow')
       }, 5000);

       $(function(){
           var owl = $('.single-item-slider');
           owl.owlCarousel({
               autoplay: false,
               items:1,
               onInitialized  : counter,
               onTranslated : counter,
               autoHeight: true,
               dots: true,
               rtl: {{ $site_direction == 'rtl'  ?  "true"  : "false"}}
           });

           function counter(event) {
               var element   = event.target;         // DOM element, in this example .owl-carousel
                   var items     = event.item.count;     // Number of items
                   var item      = event.item.index + 1;     // Position of the current item

               // it loop is true then reset counter from 1
               if(item > items) {
                   item = item - items
               }
               $('.slide-counter').html(+item+"/"+items)
           }
       });
   </script>
    {!! Toastr::message() !!}

    @if ($errors->any())
        <script>
            "use strict";
            @foreach ($errors->all() as $error)
                toastr.error('{{ translate($error) }}', Error, {
                    CloseButton: true,
                    ProgressBar: true
                });
            @endforeach
        </script>
    @endif

    <script>
"use strict";
        $(document).on('ready', function(){
            $(".direction-toggle").on("click", function () {
                if($('html').hasClass('active')){
                    $('html').removeClass('active')
                    setDirection(1);
                }else {
                    setDirection(0);
                    $('html').addClass('active')
                }
            });
            if ($('html').attr('dir') == "rtl") {
                $(".direction-toggle").find('span').text('Toggle LTR')
            } else {
                $(".direction-toggle").find('span').text('Toggle RTL')
            }

            function setDirection(status) {
                if (status === 1) {
                    $("html").attr('dir', 'ltr');
                    $(".direction-toggle").find('span').text('Toggle RTL')
                } else {
                    $("html").attr('dir', 'rtl');
                    $(".direction-toggle").find('span').text('Toggle LTR')
                }
                $.get({
                        url: '{{ route('admin.system-settings.site_direction') }}',
                        dataType: 'json',
                        data: {
                            status: status,
                        },
                        success: function() {
                        },

                    });
                }
            });

        $(document).on('ready', function() {

            if (window.localStorage.getItem('hs-builder-popover') === null) {
                $('#builderPopover').popover('show')
                    .on('shown.bs.popover', function() {
                        $('.popover').last().addClass('popover-dark')
                    });

                $(document).on('click', '#closeBuilderPopover', function() {
                    window.localStorage.setItem('hs-builder-popover', true);
                    $('#builderPopover').popover('dispose');
                });
            } else {
                $('#builderPopover').on('show.bs.popover', function() {
                    return false
                });
            }

            // BUILDER TOGGLE INVOKER
            // =======================================================
            $('.js-navbar-vertical-aside-toggle-invoker').click(function() {
                $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
            });


            // INITIALIZATION OF NAVBAR VERTICAL NAVIGATION
            // =======================================================
            var sidebar = $('.js-navbar-vertical-aside').hsSideNav();


            // INITIALIZATION OF TOOLTIP IN NAVBAR VERTICAL MENU
            // =======================================================
            $('.js-nav-tooltip-link').tooltip({
                boundary: 'window'
            })

            $(".js-nav-tooltip-link").on("show.bs.tooltip", function(e) {
                if (!$("body").hasClass("navbar-vertical-aside-mini-mode")) {
                    return false;
                }
            });


            // INITIALIZATION OF UNFOLD
            // =======================================================
            $('.js-hs-unfold-invoker').each(function() {
                var unfold = new HSUnfold($(this)).init();
            });


            // INITIALIZATION OF FORM SEARCH
            // =======================================================
            $('.js-form-search').each(function() {
                new HSFormSearch($(this)).init()
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function() {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });


            // INITIALIZATION OF DATERANGEPICKER
            // =======================================================
            $('.js-daterangepicker').daterangepicker();

            $('.js-daterangepicker-times').daterangepicker({
                timePicker: true,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(32, 'hour'),
                locale: {
                    format: 'M/DD hh:mm A'
                }
            });

            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#js-daterangepicker-predefined .js-daterangepicker-predefined-preview').html(start.format(
                    'MMM D') + ' - ' + end.format('MMM D, YYYY'));
            }

            $('#js-daterangepicker-predefined').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);


            // INITIALIZATION OF CLIPBOARD
            // =======================================================
            $('.js-clipboard').each(function() {
                var clipboard = $.HSCore.components.HSClipboard.init(this);
            });
        });
    </script>

    @stack('script_2')
    <script>
        "use strict";
        let baseUrl = '{{ url('/') }}';
    </script>
    <script src="{{dynamicAsset('public/assets/admin/js/view-pages/common.js')}}"></script>
    <audio id="myAudio">
        <source src="{{ dynamicAsset('public/assets/admin/sound/notification.mp3') }}" type="audio/mpeg">
    </audio>

    <script>
        "use strict";
        var audio = document.getElementById("myAudio");

        function playAudio() {
            audio.play();
        }

        function pauseAudio() {
            audio.pause();
        }

        $('.route-alert').on('click',function () {
            let route = $(this).data('url')
            let message = $(this).data('message')
            let title = $(this).data('title')
            let processing = $(this).data('processing')
            route_alert(route, message, title, processing);
        })
        function route_alert(route, message, title = "{{ translate('messages.are_you_sure') }}", processing = false) {
            if (processing) {
                Swal.fire({
                    title: title,
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: 'default',
                    confirmButtonColor: '#FC6A57',
                    cancelButtonText: "{{ translate('messages.Cancel') }}",
                    confirmButtonText: "{{ translate('messages.Submit') }}",
                    inputPlaceholder: "{{ translate('messages.Enter_processing_time') }}",
                    input: 'text',
                    html: message + '<br/>' + '<label>{{ translate('messages.Enter_Processing_time_in_minutes') }}</label>',
                    inputValue: processing,
                    preConfirm: (processing_time) => {
                        location.href = route + '&processing_time=' + processing_time;
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
            } else {
                Swal.fire({
                    title: title,
                    text: message,
                    type: 'warning',
                    showCancelButton: true,
                    cancelButtonColor: 'default',
                    confirmButtonColor: '#FC6A57',
                    cancelButtonText: '{{ translate('messages.No') }}',
                    confirmButtonText: '{{ translate('messages.Yes') }}',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        location.href = route;
                    }
                })

            }

        }

        $('.form-alert').on('click',function (){
            let id = $(this).data('id')
            let message = $(this).data('message')
            Swal.fire({
                title: '{{ translate('messages.Are you sure?') }}',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '#FC6A57',
                cancelButtonText: '{{ translate('messages.no') }}',
                confirmButtonText: '{{ translate('messages.Yes') }}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $('#'+id).submit()
                }
            })
        })

        function getUrlParameter(sParam) {
            var sPageURL = window.location.search.substring(1);
            var sURLVariables = sPageURL.split('&');
            for (var i = 0; i < sURLVariables.length; i++) {
                var sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] == sParam) {
                    return sParameterName[1];
                }
            }
        }

        $(window).on('load', ()=> $('.pre--loader').fadeOut(600))

        $('.log-out').on('click',function (){
                Swal.fire({
                title: '{{ translate('Do_You_Want_To_Sign_Out_?')}}',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonColor: '#FC6A57',
                cancelButtonColor: '#363636',
                confirmButtonText: `{{ translate('yes')}}`,
                cancelButtonText: `{{ translate('cancel')}}`,
                }).then((result) => {
                if (result.value) {
                location.href='{{route('logout')}}';
                } else{
                Swal.fire('{{ translate('messages.canceled') }}', '', 'info')
                }
                })
            });


            const inputs = document.querySelectorAll('input[type="tel"]');
            inputs.forEach(input => {
                window.intlTelInput(input, {
                    initialCountry: "{{$countryCode}}",
                    utilsScript: "{{ dynamicAsset('public/assets/admin/intltelinput/js/utils.js') }}",
                    autoInsertDialCode: true,
                    nationalMode: false,
                    formatOnDisplay: false,
                    strictMode: true,
                    // allowDropdown: false,
                    @if (\App\Models\SystemSetting::where('key', 'country_picker_status')->first()?->value  != 1)
                    onlyCountries: ["{{$countryCode}}"],
                    @endif
                });
            });


            function keepNumbersAndPlus(inputString) {
                let regex = /[0-9+]/g;
                let filteredString = inputString.match(regex);
            return filteredString ? filteredString.join('') : '';
            }

            $(document).on('keyup', 'input[type="tel"]', function () {
                $(this).val(keepNumbersAndPlus($(this).val()));
                });



    </script>

</body>

</html>
