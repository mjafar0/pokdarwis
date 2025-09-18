@props([
  'cover' => 'assets/images/img4.jpg',
  'category' => 'BLOG',
  'title' => 'Untitled',
  'excerpt' => 'Deskripsi singkat...',
  'url' => '#',
  'commentsCount' => 0,
])

<article class="post">
  <figure class="featured-post">
    <img src="{{ $cover }}" alt="">
  </figure>

  <div class="post-content">
    <div class="cat-meta">
      <a href="#">{{ $category }}</a>
    </div>

    <h3><a href="{{ $url }}">{{ $title }}</a></h3>
    <p>{{ $excerpt }}</p>

    <div class="post-footer d-flex justify-content-between align-items-center">
      <div class="post-btn">
        <a href="{{ $url }}" class="round-btn">Read More</a>
      </div>
      {{-- <div class="meta-comment">
        <a href="{{ $url }}">
          <i class="fas fa-comment"></i>
          <span>{{ $commentsCount }}</span>
        </a>
      </div> --}}
    </div>
  </div>
</article>