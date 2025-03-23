
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
        <img src="{{ $landing_data['system_logo'] }}" alt="">
        <h1 class="sitename">{{ $landing_data['system_name'] }}</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ route('home') }}" class="{{ Request::routeIs('home') ? 'active' : '' }}">Home<br></a></li>
          <li><a href="{{ route('about') }}" class="{{ Request::is('about') ? 'active' : '' }}">About</a></li>
          <li><a href="{{ route('blog') }}" class="{{ Request::is('blogs') || Request::is('blog/*') ? 'active' : '' }}">Blog</a></li>
          <li class="dropdown"><a href="#"><span>Services</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              @foreach ($services as $service)
              <li><a href="#">{{ $service->name }} </a></li>
              @endforeach
            </ul>
          </li>
          <li><a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a></li>
          
          <li class="dropdown">
              <a href="#"><span>{{ strtoupper(app()->getLocale()) }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
              <ul>
                  <li><a href="{{ url('lang/en') }}">🇬🇧 English</a></li>
                  <li><a href="{{ url('lang/np') }}">🇳🇵 नेपाली</a></li>
              </ul>
          </li>

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted flex-md-shrink-0" href="https://drive.google.com/file/d/1cQaWFW5_7hMjv1o80jKg9ErIyDe6_7UD/view?usp=sharing" target="_new">Download CV</a>

    </div>
  </header>