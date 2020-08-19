@extends('layouts/app')

@section('content')
<div class="container">
    <div class="">
        <div>
            @isset($category)
                <h4>Category : {{$category->name}}</h4>
            @endisset
            @isset($tag)
                <h4>Tag : {{$tag->name}}</h4>
            @endisset

            @if (!isset($tag) && !isset($category))
                <h4>All Post</h4>
            @endif
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            @forelse ($posts as $post)     
                    <div class="card mb-3">
    
                        @if ($post->thumbnail)
                        <a href="{{route('posts.show', $post->slug)}}">
                            <img style="height: 370px; object-fit: cover; object-position: center;"; class="card-img-top" src="{{$post->takeImage}}" alt="">
                        </a>
                        @endif
    
                        <div class="card-body">
                            <div>
                                <a href="{{route('categories.show', $post->category->slug)}}" class="text-secondary">
                                    <small>
                                        {{$post->category->name}} -
                                    </small>
                                </a>
                                @foreach ($post->tags as $tag)
                                    <a href="{{route('tags.show', $tag->slug)}}" class="text-secondary">
                                    <small>
                                        {{$tag->name}}
                                    </small>
                                </a>
                                @endforeach
                            </div>
                            <a href="{{route('posts.show', $post->slug)}}" class="card-title text-dark">
                                <h4>
                                    <p>{{$post->title}}</p>
                                </h4>
                            </a>
                            <div class="text-secondary my-3">
                                {{Str::limit($post['body'], 130, '')}}
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <div>
                                    <div class="media align-items-center">
                                        <img width="40" class="rounded-circle mr-3" src="{{$post->author->gravatar()}}" alt="">
                                        <div class="media-body">
                                            {{$post->author->name}}
                                        </div>
                                    </div>
                                </div>
                                <div class="text-secondary">
                                <small>
                                    Publish on {{$post->created_at->diffForHumans()}}
                                </small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-6">
                        <div class="alert alert-danger">
                            There's no post.
                        </div>
                    </div>
            @endforelse
        </div>
    </div>
            {{$posts->links('pagination::simple-tailwind') }}
</div>
@endsection