<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>@yield('title','Blog – Single')</title>

 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap/css/bootstrap.min.css') }}" media="all">

    <!-- jquery-ui css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/jquery-ui/jquery-ui.min.css') }}">

    <!-- fancybox box css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/fancybox/dist/jquery.fancybox.min.css') }}">

    <!-- Fonts Awesome CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/fontawesome/css/all.min.css') }}">

    <!-- Elmentkit Icon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/elementskit-icon-pack/assets/css/ekiticons.css') }}">

    <!-- slick slider css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/slick/slick-theme.css') }}">

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  @stack('styles')
</head>
<body>
  <div id="page" class="page">

    {{-- Header global (navbar situs) --}}
    <x-site-header active="pages" />

    <main id="content" class="site-main">

      {{-- Banner --}}
      @yield('banner')
        @php
            $pdwForBanner = $pokdarwis ?? ($post->pokdarwis ?? null);
        @endphp
        @if($pdwForBanner)
            <x-banner2 :pokdarwis="$pdwForBanner" />
        @endif

      <div class="single-post-section">
        <div class="single-post-inner">
          <div class="container">
            <div class="row">
              {{-- Kolom konten utama --}}
              <div class="col-lg-8 primary right-sidebar">
                {{-- Section konten utama diisi oleh view child --}}
                @yield('main')
              </div>

              {{-- Sidebar --}}
              <div class="col-lg-4 secondary">
                <div class="sidebar">
                  {{-- ABOUT AUTHOR (statik sederhana; silakan ganti bila perlu) --}}
                  <aside class="widget author_widget">
                    <h3 class="widget-title">ABOUT AUTHOR</h3>
                    <div class="widget-content text-center">
                        <div class="profile">
                        <figure class="avatar">
                            <a href="#">
                            {{-- Jika Pokdarwis punya logo / foto --}}
                            <img src="{{ $post->pokdarwis->logo ?? asset('assets/images/img20.jpg') }}" alt="{{ $post->pokdarwis->name_pokdarwis }}">
                            </a>
                        </figure>
                        <div class="text-content">
                            <div class="name-title">
                            <h4>
                                <a href="#">{{ $post->pokdarwis->name_pokdarwis ?? 'Pokdarwis' }}</a>
                            </h4>
                            </div>
                            <p>{{ $post->pokdarwis->deskripsi ?? 'Profil singkat tentang Pokdarwis / creator.' }}</p>
                        </div>
                        <div class="socialgroup">
                            <ul>
                            <li><a target="_blank" href="#"><i class="fab fa-facebook"></i></a></li>
                            <li><a target="_blank" href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a target="_blank" href="#"><i class="fab fa-instagram"></i></a></li>
                            </ul>
                        </div>
                        </div>
                    </div>
                    </aside>

                  {{-- RECENT POSTS (pakai $recentPosts jika dikirim controller) --}}
                  <aside class="widget widget_latest_post widget-post-thumb">
                    <h3 class="widget-title">Recent Post</h3>
                    <ul>
                      @foreach(($recentPosts ?? []) as $rp)
                        <li>
                          <figure class="post-thumb">
                            <a href="{{ route('posts.show',$rp->slug) }}">
                              <img src="{{ $rp->cover ? asset($rp->cover) : asset('assets/images/noimage.jpg') }}" alt="">
                            </a>
                          </figure>
                          <div class="post-content">
                            <h5><a href="{{ route('posts.show',$rp->slug) }}">{{ $rp->title }}</a></h5>
                            <div class="entry-meta">
                              <span class="posted-on">
                                {{ optional($rp->published_at instanceof \Carbon\Carbon ? $rp->published_at : \Carbon\Carbon::parse($rp->published_at))->format('M d, Y') }}
                              </span>
                              {{-- <span class="comments-link">{{ $rp->comments_count ?? 0 }} Comments</span> --}}
                            </div>
                          </div>
                        </li>
                      @endforeach
                    </ul>
                  </aside>

                  <aside class="widget widget_adds">
                    <figure><img src="{{ asset('assets/images/add-banner.jpg') }}" alt=""></figure>
                  </aside>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </main>

    <x-footer />

    <a id="backTotop" href="#" class="to-top-icon"><i class="fas fa-chevron-up"></i></a>
  </div>

  {{-- JS --}}
  <script src="{{ asset('assets/vendors/jquery/jquery.js') }}"></script>
  <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/jquery-ui/jquery-ui.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/slick/slick.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/fancybox/dist/jquery.fancybox.min.js') }}"></script>
  <script src="{{ asset('assets/js/custom.min.js') }}"></script>
  @stack('scripts')
</body>
</html>
