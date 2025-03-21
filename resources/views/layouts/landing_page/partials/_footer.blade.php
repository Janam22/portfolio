
<footer id="footer" class="footer">

<div class="footer-newsletter">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-lg-6">
        <h4>I'm Available for freelancing</h4>
        <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
        <p class="mb-0"><a href="{{ route('contact') }}" class="btn btn-primary py-3 px-5">Hire me</a></p>
      </div>
    </div>
  </div>
</div>	

<div class="container footer-top">
  <div class="row gy-4">
    <div class="col-lg-4 col-md-6 footer-about">
      <a href="index.html" class="d-flex align-items-center">
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
        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}">Home</a></li>
        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('home') }}#about">About me</a></li>
        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('blog') }}">Blogs</a></li>
        <li><i class="bi bi-chevron-right"></i> <a href="{{ route('contact') }}">Contact me</a></li>
      </ul>
    </div>

    <div class="col-lg-2 col-md-3 footer-links">
      <h4>Our Services</h4>
      <ul>
        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
      </ul>
    </div>

    <div class="col-lg-4 col-md-12">
      <h4>Follow Me</h4>
      <p>I am available on most of the social media.</p>
      <div class="social-links d-flex">
        <a href=""><i class="bi bi-github"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <!-- <a href=""><i class="bi bi-twitter-x"></i></a> -->
      </div>
    </div>

  </div>
</div>

<div class="container copyright text-center mt-4">
  <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ $landing_data['system_name'] }}</strong> <span>{{ $landing_data['footer_text'] }}</span></p>
</div>

</footer>