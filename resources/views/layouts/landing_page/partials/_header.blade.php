
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
          <li><a href="{{ route('blog') }}" class="{{ Request::is('blogs') || Request::is('blogs/*') ? 'active' : '' }}">Blog</a></li>
          <li class="dropdown"><a href="#"><span>Services</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Service 1</a></li>
              <li><a href="#">Service 2</a></li>
              <li><a href="#">Service 3</a></li>
              <li><a href="#">Service 4</a></li>
            </ul>
          </li>
          <li class="dropdown"><a href="#"><span>Projects</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Project 1</a></li>
              <li><a href="#">Project 2</a></li>
              <li><a href="#">Project 3</a></li>
              <li><a href="#">Project 4</a></li>
            </ul>
          </li>
          <li><a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted flex-md-shrink-0" href="{{ route('home') }}">Download CV</a>

    </div>
  </header>