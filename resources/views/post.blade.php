@extends('layouts.app')

@section('content')
<div class="container">
    <div class="blog-post">
        <svg class="bd-placeholder-img" width="100%" height="150" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="{{$post->title}}"><title>{{$post->title}}</title><rect width="100%" height="100%" fill="#55595c"/><text x="45%" y="50%" fill="#eceeef" dy=".3em">{{$post->title}}</text></svg>
        <h2 class="blog-post-title">{{$post->title}}</h2>
        <strong class="d-inline-block mb-2 text-primary">{{$post->categorie->title}}</strong>
        <p class="blog-post-meta">{{$post->created_at}} by <a href="#">{{$post->user->name}}</a></p>

        <p>{{$post->content}}</p>
    </div>
</div>
@endsection
