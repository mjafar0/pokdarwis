@extends('layouts.blogSingleLayout')
@section('title', $post->title)



@section('main')
  {{-- Feature image --}}
  <figure class="feature-image">
    <img src="{{ $post->cover_url ? asset($post->cover_url) : asset('assets/images/noimage.jpg') }}" alt="">
  </figure>

  {{-- Meta --}}
  <div class="entry-meta">
    <span class="byline">
      <a href="#">{{ $post->pokdarwis->name_pokdarwis ?? 'Demoteam' }}</a>
    </span>
    <span class="posted-on">
      {{ optional($post->published_at instanceof \Carbon\Carbon ? $post->published_at : \Carbon\Carbon::parse($post->published_at))->format('M d, Y') }}
    </span>
    {{-- Comments --}}
    {{-- <span class="comments-link">
      <a href="#commentArea">{{ $post->comments_count ?? 0 }} Comments</a>
    </span> --}}
  </div>

  {{-- Konten --}}
  <article class="single-content-wrap">
    {!! $post->content !!}
  </article>
@endsection
