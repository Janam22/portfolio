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
                        <p class="mb-0"><a href="https://drive.google.com/file/d/1ROsGakdO8o6_22xmHIRsKvGa_G79pJoD/view?usp=sharing" target="_new" class="btn btn-primary py-3 px-5">Download CV</a></p>
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

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.
                </p>
                <div class="profile mt-auto">
                    <img src="{{ dynamicAsset('public/assets/landing/img/testimonials/testimonials-1.jpg') }}" class="testimonial-img" alt="">
                    <h3>Saul Goodman</h3>
                    <h4>Ceo &amp; Founder</h4>
                </div>
                </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                </p>
                <div class="profile mt-auto">
                    <img src="{{ dynamicAsset('public/assets/landing/img/testimonials/testimonials-2.jpg') }}" class="testimonial-img" alt="">
                    <h3>Sara Wilsson</h3>
                    <h4>Designer</h4>
                </div>
                </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                </p>
                <div class="profile mt-auto">
                    <img src="{{ dynamicAsset('public/assets/landing/img/testimonials/testimonials-3.jpg') }}" class="testimonial-img" alt="">
                    <h3>Jena Karlis</h3>
                    <h4>Store Owner</h4>
                </div>
                </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.
                </p>
                <div class="profile mt-auto">
                    <img src="{{ dynamicAsset('public/assets/landing/img/testimonials/testimonials-4.jpg') }}" class="testimonial-img" alt="">
                    <h3>Matt Brandon</h3>
                    <h4>Freelancer</h4>
                </div>
                </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
                <div class="testimonial-item">
                <p>
                    Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.
                </p>
                <div class="profile mt-auto">
                    <img src="{{ dynamicAsset('public/assets/landing/img/testimonials/testimonials-5.jpg') }}" class="testimonial-img" alt="">
                    <h3>John Larson</h3>
                    <h4>Entrepreneur</h4>
                </div>
                </div>
            </div><!-- End testimonial item -->

            </div>
            <div class="swiper-pagination"></div>
        </div>

        </div>

    </section><!-- /Testimonials Section -->

@endsection