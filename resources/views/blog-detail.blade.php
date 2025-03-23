@extends('layouts.landing_page.app')
@section('title', 'Blog Details' . ' | ' . $landing_data['system_name'] )

@section('content')
<br><br><br><br>

    <!-- Page Title -->
    <div class="page-title">
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('blog') }}">Blogs</a></li>
            <li class="current">{{ $blog_detail->blog_title }}</li>
          </ol>
        </div>
      </nav>
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>{{ $blog_detail->blog_title }}</h1>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article">

                <div class="post-img">
                  <img src="{{ $blog_detail['image_full_url'] }}" alt="" class="img-fluid">
                </div>

                <h2 class="title">{{ $blog_detail->blog_title }}</h2>

                <div class="meta-top">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{ route('blog.detail', ['slug' => $blog_detail->slug]) }}">{{ $blog_detail->author_name}}</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('blog.detail', ['slug' => $blog_detail->slug]) }}"><time datetime="2020-01-01">{{ \App\CentralLogics\Helpers::date_format($blog_detail->created_at) }}</time></a></li>
                  </ul>
                </div><!-- End meta top -->

                <div class="content">
                  {!! $blog_detail->blog_details !!}
                </div><!-- End post content -->

                @if ($blog_detail->tags)
                <div class="meta-bottom">
                  <i class="bi bi-tags"></i>
                  <ul class="tags">
                    @foreach (explode(',', $blog_detail->tags) as $tag)
                        <li><a href="{{ route('blog', ['category' => request()->category ?? null, 'tag' => $tag]) }}">{{ trim($tag) }}</a></li>
                    @endforeach
                  </ul>
                </div><!-- End meta bottom -->
                @endif

              </article>

            </div>
          </section><!-- /Blog Details Section -->

        </div>

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Search Widget -->
            <div class="search-widget widget-item">

              <h3 class="widget-title">Search</h3>
              <form action="{{ route('blog') }}" method="get">
                <input type="text" name="search" value="{{ request()?->search ?? null }}" placeholder="{{ translate('messages.search_by_title') }}">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>

            </div><!--/Search Widget -->

            @if (!empty($uniqueCategories))
            <!-- Categories Widget -->
            <div class="categories-widget widget-item">

              <h3 class="widget-title">Categories</h3>
              <ul class="mt-3">
                @foreach ($uniqueCategories as $uniqueCategory)
                <li><a href="{{ route('blog', ['category' => $uniqueCategory->category, 'tag' => request('tag')]) }}">{{ translate($uniqueCategory->category) }} <span>({{ $uniqueCategory->count }})</span></a></li>
                @endforeach
              </ul>

            </div><!--/Categories Widget -->
            @endif

            @if ($recent_blogs && $recent_blogs->count() > 0)
            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Recent Posts</h3>
                @foreach ($recent_blogs as $recent_blog)
                <div class="post-item">
                  <img src="{{ $recent_blog['image_full_url'] }}" alt="" class="flex-shrink-0">
                  <div>
                    <h4><a href="{{ route('blog.detail', ['slug' => $blog_detail->slug]) }}">{{ $recent_blog->blog_title }}</a></h4>
                    <time datetime="2020-01-01">{{ \App\CentralLogics\Helpers::date_format($recent_blog->created_at) }}</time>
                  </div>
                </div><!-- End recent post item-->
                @endforeach

            </div><!--/Recent Posts Widget -->
            @endif

            @if (!empty($uniqueTags))
            <!-- Tags Widget -->
            <div class="tags-widget widget-item">

              <h3 class="widget-title">Tags</h3>
              <ul>
                @foreach ($uniqueTags as $uniqueTag)
                <li><a href="{{ route('blog', ['category' => request()->category ?? null, 'tag' => $uniqueTag]) }}">{{ $uniqueTag }}</a></li>
                @endforeach
              </ul>

            </div><!--/Tags Widget -->
            @endif
          </div>

        </div>

      </div>
    </div>

@endsection