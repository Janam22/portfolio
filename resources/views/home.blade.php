@extends('layouts.landing_page.app')
@section('title', 'Home' . ' | ' . $landing_data['system_name'] )

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1 data-aos="fade-up">Janam Pandey</h1>      
            <div class="container">
              <p class="static-text" style="display: inline-block;font-size:23px;">I AM</p>
              <p data-aos="fade-up" data-aos-delay="100" class="dynamic-text" style="color:green;display: inline-block;"> </p>
            </div>
            <p data-aos="fade-up" data-aos-delay="100">We are team of talented designers making websites with Bootstrap</p>
            <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
              <a href="{{ route('contact') }}" class="btn-get-started">{{ translate('messages.hire_me') }} <i class="bi bi-arrow-right"></i></a>
              <a href="https://github.com/Janam22" target="_new" class="btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i class="bi bi-github"></i><span>{{ translate('messages.view_github_profile') }}</span></a>
            </div>
          </div>
          <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="{{ dynamicAsset('public/assets/landing/img/hero-img.png') }}" class="img-fluid animated" alt="">
          </div>
        </div>
      </div>
    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h1>{{ translate('messages.who_i_am') }}</h1>
              <h2>Expedita voluptas omnis cupiditate totam eveniet nobis sint iste. Dolores est repellat corrupti reprehenderit.</h2>
              <p>
                {!! Str::limit(strip_tags($landing_data['about_me']), 200, '...') !!}
              </p>
              <div class="text-center text-lg-start">
                <a href="{{ route('about') }}" class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>{{ translate('messages.read_more') }}</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="{{ $landing_data['about_me_image_full_url'] }}" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- /About Section -->

    <!-- Values Section -->
    <section id="values" class="values section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>My Values</h2>
        <p>What I value most<br></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card">
              <img src="{{ dynamicAsset('public/assets/landing/img/values-1.png') }}" class="img-fluid" alt="">
              <h3>Team Work</h3>
              <p>I collaborate effectively, fostering a supportive and solution-driven work environment.</p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card">
              <img src="{{ dynamicAsset('public/assets/landing/img/values-2.png') }}" class="img-fluid" alt="">
              <h3>High Performance</h3>
              <p>I consistently strive for excellence, delivering quality results with efficiency.</p>
            </div>
          </div><!-- End Card Item -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card">
              <img src="{{ dynamicAsset('public/assets/landing/img/values-3.png') }}" class="img-fluid" alt="">
              <h3>Delivery on Time</h3>
              <p>I prioritize deadlines, ensuring timely and reliable project completion.</p>
            </div>
          </div><!-- End Card Item -->

        </div>

      </div>

    </section><!-- /Values Section -->

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

    <!-- Features Section -->
    <section id="features" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Technologies</h2>
        <p>My Tech Stack<br></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">

          <div class="col-xl-6" data-aos="zoom-out" data-aos-delay="100">
            <img src="{{ dynamicAsset('public/assets/landing/img/features.png') }}" class="img-fluid" alt="">
          </div>

          <div class="col-xl-6 d-flex">
            <div class="row align-self-center gy-4">

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Laravel</h3>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Facilis neque ipsa</h3>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Volup amet volupt</h3>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Rerum omnis sint</h3>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Alias possimus</h3>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6" data-aos="fade-up" data-aos-delay="700">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Repellendus molli</h3>
                </div>
              </div><!-- End Feature Item -->

            </div>
          </div>

        </div>

      </div>

    </section><!-- /Features Section -->

    <!-- Alt Features Section -->
    <section id="alt-features" class="alt-features section">

      <div class="container">

        <div class="row gy-5">

          <div class="col-xl-7 d-flex order-2 order-xl-1" data-aos="fade-up" data-aos-delay="200">

            <div class="row align-self-center gy-5">

              <div class="col-md-6 icon-box">
                <i class="bi bi-award"></i>
                <div>
                  <h4>Corporis voluptates sit</h4>
                  <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6 icon-box">
                <i class="bi bi-card-checklist"></i>
                <div>
                  <h4>Ullamco laboris nisi</h4>
                  <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6 icon-box">
                <i class="bi bi-dribbble"></i>
                <div>
                  <h4>Labore consequatur</h4>
                  <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6 icon-box">
                <i class="bi bi-filter-circle"></i>
                <div>
                  <h4>Beatae veritatis</h4>
                  <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6 icon-box">
                <i class="bi bi-lightning-charge"></i>
                <div>
                  <h4>Molestiae dolor</h4>
                  <p>Et fuga et deserunt et enim. Dolorem architecto ratione tensa raptor marte</p>
                </div>
              </div><!-- End Feature Item -->

              <div class="col-md-6 icon-box">
                <i class="bi bi-patch-check"></i>
                <div>
                  <h4>Explicabo consectetur</h4>
                  <p>Est autem dicta beatae suscipit. Sint veritatis et sit quasi ab aut inventore</p>
                </div>
              </div><!-- End Feature Item -->

            </div>

          </div>

          <div class="col-xl-5 d-flex align-items-center order-1 order-xl-2" data-aos="fade-up" data-aos-delay="100">
            <img src="{{ dynamicAsset('public/assets/landing/img/alt-features.png') }}" class="img-fluid" alt="">
          </div>

        </div>

      </div>

    </section><!-- /Alt Features Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Check My Services<br></p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item item-cyan position-relative">
              <i class="bi bi-activity icon"></i>
              <h3>Nesciunt Mete</h3>
              <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>
              <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-item item-orange position-relative">
              <i class="bi bi-broadcast icon"></i>
              <h3>Eosle Commodi</h3>
              <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
              <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-item item-teal position-relative">
              <i class="bi bi-easel icon"></i>
              <h3>Ledo Markt</h3>
              <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
              <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item item-red position-relative">
              <i class="bi bi-bounding-box-circles icon"></i>
              <h3>Asperiores Commodi</h3>
              <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
              <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item item-indigo position-relative">
              <i class="bi bi-calendar4-week icon"></i>
              <h3>Velit Doloremque.</h3>
              <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
              <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item item-pink position-relative">
              <i class="bi bi-chat-square-text icon"></i>
              <h3>Dolori Architecto</h3>
              <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
              <a href="#" class="read-more stretched-link"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Portfolio Section -->
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Works</h2>
        <p>Check My latest work</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
          @foreach ($projects as $project)
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
              <div class="portfolio-content h-100">
                <img src="{{ $project['image_full_url'] }}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>{{ $project->services->name }}</h4>
                  <p>{{ $project->name }}</p>
                  <a href="{{ $project['image_full_url'] }}" title="{{ $project->name }}" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                  <a href="{{ $project->link }}" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                </div>
              </div>
            </div><!-- End Portfolio Item -->
          @endforeach

          </div><!-- End Portfolio Container -->

        </div>

      </div>

    </section><!-- /Portfolio Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>{{ translate('messages.testimonials') }}</h2>
        <p>{{ translate('messages.what_client_say_about_me?') }}<br></p>
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

    <!-- Clients Section -->
    <section id="clients" class="clients section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Clients</h2>
        <p>I work with best clients<br></p>
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
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="{{ dynamicAsset('public/assets/landing/img/clients/client-1.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ dynamicAsset('public/assets/landing/img/clients/client-2.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ dynamicAsset('public/assets/landing/img/clients/client-3.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ dynamicAsset('public/assets/landing/img/clients/client-4.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ dynamicAsset('public/assets/landing/img/clients/client-5.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ dynamicAsset('public/assets/landing/img/clients/client-6.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ dynamicAsset('public/assets/landing/img/clients/client-7.png') }}" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="{{ dynamicAsset('public/assets/landing/img/clients/client-8.png') }}" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Clients Section -->

    <!-- Recent Posts Section -->
    <section id="recent-posts" class="recent-posts section">

      <!-- Section Title -->
      <div class="container d-flex justify-content-between align-items-center text-center section-title" data-aos="fade-up">
        <div class="mx-auto">
        <h2>Recent Posts</h2>
        <p>Recent posts from my Blog</p>
        </div>
        <a href="{{ route('blog') }}">View All <i class="bi bi-arrow-right"></i></a>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">
          @foreach ($blogs as $blog)
          <div class="col-xl-4 col-md-6">
            <div class="post-item position-relative h-100" data-aos="fade-up" data-aos-delay="100">

              <div class="post-img position-relative overflow-hidden">
                <img src="{{ $blog['image_full_url'] }}" class="img-fluid" alt="">
                <span class="post-date">{{ \App\CentralLogics\Helpers::date_format($blog->created_at) }}</span>
              </div>

              <div class="post-content d-flex flex-column">

                <h3 class="post-title">{{ $blog->blog_title }}</h3>

                <div class="meta d-flex align-items-center">
                  <div class="d-flex align-items-center">
                    <i class="bi bi-person"></i> <span class="ps-2">{{ $blog->author_name }}</span>
                  </div>
                  <!-- <span class="px-3 text-black-50">/</span>
                  <div class="d-flex align-items-center">
                    <i class="bi bi-folder2"></i> <span class="ps-2">Politics</span>
                  </div> -->
                </div>

                <hr>

                <a href="{{ route('blog.detail', ['slug' => $blog->slug]) }}" class="readmore stretched-link"><span>Read More</span><i class="bi bi-arrow-right"></i></a>

              </div>

            </div>
          </div><!-- End post item -->
          @endforeach

        </div>

      </div>

    </section><!-- /Recent Posts Section -->
    <script>
        const words = ["LARAVEL DEVELOPER", "DESIGNER", "FREELANCER"];
        const dynamicText = document.querySelector(".dynamic-text");
        let index = 0;

        function changeWord() {
            dynamicText.style.opacity = 0;  // Fade out
            setTimeout(() => {
                dynamicText.textContent = words[index];
                dynamicText.style.opacity = 1;  // Fade in
                index = (index + 1) % words.length; // Loop back to start
            }, 100); // Wait for fade-out effect
        }

        changeWord(); // Initial call
        setInterval(changeWord, 2000); // Change word every 2 seconds
    </script>
@endsection