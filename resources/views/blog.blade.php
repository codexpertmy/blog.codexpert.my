@extends('layouts.web')
@section('title')
{{ $post->title }}
@endsection
@section('sub_title')
	<p>{{ $post->sub_title }}</p>
@endsection
@section('content')
<div class="row">
	<div class="simple-navigation">
		<a href="{{ url('/') }}"><< Back to Home</a>
	</div>

	<div class="blog-content">
		{!! $post->body !!}
		<h2>Related Posts</h2>
		@foreach($relatedPost as $related)
		<h2><a href="{{ route('post.show',[$related->hash_id,$related->slug]) }}">{{ $related->title }}</a></h2>
		<p>{!! substr($related->body,0,100) !!}</p>
		<p>Published Date : {{ $related->created_at->format('d F Y')}}</p>
		<p><span class="label label-primary">{{ $related->category->name }}</span></p>
		<p><a class="btn btn-secondary" href="{{ route('post.show',[$related->hash_id,$related->slug]) }}" role="button">Continue read &raquo;</a></p>
		@endforeach
		<div style="clear: both;"></div>
		<div id="disqus_thread"></div>
	</div>
</div>
@endsection
