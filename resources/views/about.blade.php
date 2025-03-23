@extends('layouts.landing_page.app')
@section('title', 'About' . ' | ' . $landing_data['system_name'] )

@section('content')
<br><br><br><br>

    <!-- About Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>About</h2>
        <p>About Me</p>
      </div><!-- End Section Title -->
      
        <div class="container">
            <div class="row">
                <div class="col-lg-5 d-flex align-items-center" data-aos="fade-up" data-aos-delay="200">
                    <img class="img-fluid" src="{{ dynamicAsset('public/assets/landing/img/about-me.png') }}" alt="">
                </div>

                <div class="offset-lg-1 col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                    <div class="content">
                        <h1>Let’s <br>
                            Introduce about <br>
                            myself</h1>
                            {!! $landing_data['about_me'] !!}
                        <p class="mb-0"><a href="https://drive.google.com/file/d/1cQaWFW5_7hMjv1o80jKg9ErIyDe6_7UD/view?usp=sharing" target="_new" class="btn btn-primary py-3 px-5">Download CV</a></p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Stats Section -->
    <section id="stats" class="stats section">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

            <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
                <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
                <div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $landing_data['client_count'] }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Happy Clients</p>
                </div>
            </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
                <i class="bi bi-journal-richtext color-orange flex-shrink-0" style="color: #ee6c20;"></i>
                <div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $landing_data['project_count'] }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Projects</p>
                </div>
            </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
                <i class="bi bi-headset color-green flex-shrink-0" style="color: #15be56;"></i>
                <div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $landing_data['service_count'] }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Services</p>
                </div>
            </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
                <i class="bi bi-people color-pink flex-shrink-0" style="color: #bb0852;"></i>
                <div>
                <span data-purecounter-start="0" data-purecounter-end="{{ $landing_data['team_count'] }}" data-purecounter-duration="1" class="purecounter"></span>
                <p>Team Members</p>
                </div>
            </div>
            </div><!-- End Stats Item -->

        </div>

        </div>

    </section><!-- /Stats Section -->


    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
        <p>What client say about me<br></p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
            {
                "loop": true,
                "speed": 600,
                "autoplay": {
                "delay": 5000
                },
                "slidesPerView": "auto",
                "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
                },
                "breakpoints": {
                "320": {
                    "slidesPerView": 1,
                    "spaceBetween": 40
                },
                "1200": {
                    "slidesPerView": 3,
                    "spaceBetween": 1
                }
                }
            }
            </script>
            <div class="swiper-wrapper">
            @foreach ($testimonials as $testimonial)
            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    {{ $testimonial->message }}
                </p>
                <div class="profile mt-auto">
                    <img src="{{ $testimonial['image_full_url'] }}" class="testimonial-img" alt="">
                    <h3>{{ $testimonial->name }}</h3>
                    <h4>{{ $testimonial->designation }}</h4>
                </div>
                </div>
            </div><!-- End testimonial item -->
            @endforeach

            </div>
            <div class="swiper-pagination"></div>
        </div>

        </div>

    </section><!-- /Testimonials Section -->

@endsection