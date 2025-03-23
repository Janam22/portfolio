@extends('layouts.landing_page.app')
@section('title', 'Blogs' . ' | ' . $landing_data['system_name'] )

@section('content')
<br><br><br><br>
    <!-- Page Title -->
    <div class="page-title">
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li class="current">Blogs</li>
          </ol>
        </div>
      </nav>
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Blogs</h1>
              <p class="mb-0">Get my latest blogs here..</p>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Posts Section -->
          <section id="blog-posts" class="blog-posts section">

            <div class="container">

              <div class="row gy-4">
              @if ($blogs && $blogs->count() > 0)
                @foreach ($blogs as $blog)
                  <div class="col-12">
                    <article>

                      <div class="post-img">
                        <img src="{{ $blog['image_full_url'] }}" alt="" class="img-fluid">
                      </div>

                      <h2 class="title">
                        <a href="{{ route('blog.detail', ['slug' => $blog->slug]) }}">{{ $blog->blog_title }}</a>
                      </h2>

                      <div class="meta-top">
                        <ul>
                          <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="{{ route('blog.detail', ['slug' => $blog->slug]) }}">{{ $blog->author_name }}</a></li>
                          <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="{{ route('blog.detail', ['slug' => $blog->slug]) }}"><time datetime="2022-01-01">{{ \App\CentralLogics\Helpers::date_format($blog->created_at) }}</time></a></li>
                        </ul>
                      </div>

                      <div class="content">
                        <p>
                          {!! Str::limit(strip_tags($blog->blog_details), 200, '...') !!}
                        </p>

                        <div class="read-more">
                          <a href="{{ route('blog.detail', ['slug' => $blog->slug]) }}">Read More</a>
                        </div>
                      </div>

                    </article>
                  </div><!-- End post list item -->
                @endforeach
              @else
                <div class="col-12">
                  <h2>Not available</h2>
                </div>
              @endif

              </div><!-- End blog posts list -->

            </div>

          </section><!-- /Blog Posts Section -->

          <!-- Blog Pagination Section -->
          <section id="blog-pagination" class="blog-pagination section">

            <div class="container">
              <div class="d-flex justify-content-center">
                <ul>
                  <li>{{ $blogs->links() }}</li>
                </ul>
              </div>
            </div>

          </section><!-- /Blog Pagination Section -->

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
                    <h4><a href="{{ route('blog.detail', ['slug' => $recent_blog->slug]) }}">{{ $recent_blog->blog_title }}</a></h4>
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