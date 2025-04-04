
<div class="footer-newsletter">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-6">
        <h4>{{ translate('messages.I_am_available_for_work') }}</h4>
        <p>{{ translate('messages.I_am_available_for_PHP/Laravel_development_and_web_projects-let_us_build_something_great_together!') }}</p>
        <p class="mb-0"><a href="{{ route('contact') }}" class="btn btn-primary py-3 px-5">{{ translate('messages.hire_me') }}</a></p>
      </div>
    </div>
  </div>
</div>	

<footer id="footer" class="footer">
  
<div class="container footer-top">
  <div class="row gy-4">
    <div class="col-lg-4 col-md-6 footer-about">
      <a href="{{ route('home') }}" class="d-flex align-items-center">
        <span class="sitename">{{ $landing_data['system_name'] }}</span>
      </a>
      <div class="footer-contact pt-3">
        <p>{{ $landing_data['address'] }}</p>
        <p class="mt-3"><strong>Phone:</strong> <span>{{ $landing_data['phone'] }}</span></p>
        <p><strong>Email:</strong> <span>{{ $landing_data['email_address'] }}</span></p>
      </div>
    </div>

    <div class="col-lg-2 col-md-3 footer-links">
      <h4>Useful Links</h4>
      <ul>
        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}">{{ translate('messages.home') }}</a></li>
        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('about') }}">{{ translate('messages.about_me') }}</a></li>
        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('blog') }}">{{ translate('messages.blog') }}</a></li>
        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('contact') }}">{{ translate('messages.contact') }}</a></li>
      </ul>
    </div>

    <div class="col-lg-2 col-md-3 footer-links">
      <h4>My Services</h4>
      <ul>
        @foreach ($services as $service)
        <li><i class="bi bi-chevron-right"></i> <a href="#">{{ $service->name }}</a></li>
        @endforeach
      </ul>
    </div>

    <div class="col-lg-4 col-md-12">
      <h4>Follow Me</h4>
      <p>{{ translate('messages.I_am_available_on_most_of_the_social_media.') }}</p>
      <div class="social-links d-flex">
        @foreach ($social_media as $socialmedia)
        @if($socialmedia->name == 'github')
        <a href="{{ $socialmedia->link }}" target="_new"><i class="bi bi-github"></i></a>
        @endif
        @if($socialmedia->name == 'linkedin')
        <a href="{{ $socialmedia->link }}" target="_new"><i class="bi bi-linkedin"></i></a>
        @endif
        @if($socialmedia->name == 'facebook')
        <a href="{{ $socialmedia->link }}" target="_new"><i class="bi bi-facebook"></i></a>
        @endif
        @if($socialmedia->name == 'instagram')
        <a href="{{ $socialmedia->link }}" target="_new"><i class="bi bi-instagram"></i></a>
        @endif
        @endforeach
        <!-- <a href=""><i class="bi bi-twitter-x"></i></a> -->
      </div>
    </div>

  </div>
</div>

<div class="container copyright text-center mt-4">
  <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ $landing_data['system_name'] }}</strong> <span>{{ $landing_data['footer_text'] }}</span></p>
</div>

</footer>