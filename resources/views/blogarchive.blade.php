@extends('layouts.blogLayout')
@section('title','Blog Archive')

@section('banner')

@section('main')
  <div class="grid blog-inner row">
    @forelse($posts as $post)
      <div class="grid-item col-md-6">
        <x-blog-card
          :image="$post->cover ? asset($post->cover) : asset('assets/images/noimage.jpg')"
          :category="'TOUR'"
          :title="$post->title"
          :excerpt="$post->excerpt"
          :url="route('posts.show', $post->slug)"
          :commentsCount="$post->comments_count ?? 0"
        />
      </div>
    @empty
      <p class="text-muted">No Posts Yet.</p>
    @endforelse

    {{-- Pagination Article/Blog --}}
        @if ($posts->hasPages())
<div class="post-navigation-wrap">
  <nav>
    <ul class="pagination">

      {{-- Tombol Previous --}}
        @if ($posts->onFirstPage())
            <li class="disabled">
            <a href="javascript:void(0)">
                <i class="fas fa-arrow-left"></i>
            </a>
            </li>
        @else
            <li>
            <a href="{{ $posts->previousPageUrl() }}">
                <i class="fas fa-arrow-left"></i>
            </a>
            </li>
        @endif

        {{-- Nomor Halaman --}}
        @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
            @if ($page == $posts->currentPage())
            <li class="active"><a href="javascript:void(0)">{{ $page }}</a></li>
            @else
            <li><a href="{{ $url }}">{{ $page }}</a></li>
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($posts->hasMorePages())
            <li>
            <a href="{{ $posts->nextPageUrl() }}">
                <i class="fas fa-arrow-right"></i>
            </a>
            </li>
        @else
            <li class="disabled">
            <a href="javascript:void(0)">
                <i class="fas fa-arrow-right"></i>
            </a>
            </li>
        @endif

    </ul>
  </nav>
</div>
@endif
  </div>

  {{-- Pagination --}}
  {{-- <div class="post-navigation-wrap">
    {{ $posts->links() }}
  </div> --}}
@endsection
