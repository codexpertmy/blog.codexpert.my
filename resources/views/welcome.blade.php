@extends('layouts.web')

@section('title')
  Hi, Im Tajul Asri
@endsection

@section('sub_title')
  @include('layouts.main_header')
@endsection

@section('content')
    <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-10">
            @forelse($posts as $post)
            <div class="blog-content" style="margin-bottom: 40px;">
            <h2 class="blog-post-title">
              <a href="#">{{ $post->title }}</a>
            </h2>
            <p class="blog-post-meta">{{ $post->created_at->format('d F Y')}} by <a href="#">{{ $post->user->name }}</a></p>
            <p><span class="label label-primary">{{ $post->category->name }}</span></p>

            {!! strip_tags(substr($post->body,0,strlen($post->body) / 5)) !!}

            <p><a class="btn btn-default" href="{{ route('post.show',[$post->hash_id,$post->slug]) }}" role="button">Continue read &raquo;</a></p>
          </div>

       @empty
          <h4>I still looking for suitable time to create articles.</h4>
       @endforelse
        </div>

        <div class="col-md-2">
          <h1>Related Categories</h1>
          @foreach(get_category_items() as $category)
            <h2><span class="label label-info label-large">
              <a href="{{ route('post.related',$category->code) }}" class="category-link">{{ $category->name }}</a>
            </span></h2>
          @endforeach
        </div>
      </div>
@endsection
