<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title -->
    <title>@yield('title')</title>
    <!-- Favicon -->
    @php($logo = \App\Models\SystemSetting::where(['key' => 'icon'])->first()->value)
    <link rel="shortcut icon" href="">
    <link rel="icon" type="image/x-icon" href="{{ dynamicStorage('storage/app/public/system/' . $logo ?? '') }}">

    <!-- Favicons -->
    <link href="{{ dynamicAsset('public/assets/landing/img/favicon.png') }}" rel="icon">
    <link href="{{ dynamicAsset('public/assets/landing/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ dynamicAsset('public/assets/landing/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ dynamicAsset('public/assets/landing/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ dynamicAsset('public/assets/landing/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ dynamicAsset('public/assets/landing/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ dynamicAsset('public/assets/landing/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ dynamicAsset('public/assets/landing/css/main.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ dynamicAsset('public/assets/admin/css/toastr.css') }}">
</head>

<body>

    <!-- JS Preview mode only -->
    @include('layouts.landing_page.partials._header')
    <!-- END ONLY DEV -->

    <main class="main">
        <!-- Content -->
        @yield('content')
        <!-- End Content -->
    </main>
    <!-- ========== END MAIN CONTENT ========== -->

    <!-- Footer -->
    @include('layouts.landing_page.partials._footer')
    <!-- End Footer -->

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    @stack('script')
    <!-- Vendor JS Files -->
    <script src="{{ dynamicAsset('public/assets/landing/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ dynamicAsset('public/assets/landing/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ dynamicAsset('public/assets/landing/vendor/aos/aos.js') }}"></script>
    <script src="{{ dynamicAsset('public/assets/landing/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ dynamicAsset('public/assets/landing/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ dynamicAsset('public/assets/landing/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ dynamicAsset('public/assets/landing/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ dynamicAsset('public/assets/landing/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{dynamicAsset('public/assets/admin/js/jquery.min.js')}}"></script>

    <!-- Main JS File -->
    <script src="{{ dynamicAsset('public/assets/landing/js/main.js') }}"></script>
    <script src="{{ dynamicAsset('public/assets/admin/js/toastr.js') }}"></script>

    {!! Toastr::message() !!}
    @if ($errors->any())
        <script>
            @foreach($errors->all() as $error)
            toastr.error('{{$error}}', Error, {
                CloseButton: true,
                ProgressBar: true
            });
            @endforeach
        </script>
    @endif

</body>

</html>
