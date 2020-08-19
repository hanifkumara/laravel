@extends('layouts/app')

@section('title', $post->title)
    
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if ($post->thumbnail)
                        <img style="height: 450px; object-fit: cover; object-position: center;"; class="rounded w-100" src="{{$post->takeImage}}" alt="">
                    @endif
                    <h2>{{$post->title}}</h2>
                    <div class="text-secondary mb-3">
                        <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a> 
                        &middot; {{$post->created_at->format("d F ,Y")}}
                        &middot;
                        @foreach ($post->tags as $t)
                            <a href="/tags/{{$t->slug}}">{{$t->name}}</a>
                        @endforeach
                        <div class="mediaa">
                            <img width="60" class="rounded-circle" src="{{$post->author->gravatar()}}" alt="">
                            <div class="media-boddy">
                                {{$post->author->name}}
                            </div>
                        </div>
                    </div>
                    <p>{!! nl2br($post->body) !!}</p>
                    <div>

                        <!-- Button trigger modal -->
                    @can('delete', $post)
                        <div class="d-flex mt-3">
                            <button type="button" class="btn btn-sm btn-danger mr-1" data-toggle="modal" data-target="#exampleModal">
                                Delete
                            </button>
                            <a href="/post/{{$post->slug}}/edit" class="btn btn-sm btn-success">Edit</a>
                        </div>
                        

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">yakin akan menghapusnya!?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div>
                                    {{$post->title}}
                                </div>
                                <div class="text-secondary">
                                    <small>Published: {{$post->created_at->format('d F, Y')}}</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form method="post" action="/post/{{$post->slug}}/delete">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                    @endcan        
                </div>
            </div>
            <div class="col-md-4">
                @foreach ($posts as $post)
                    <div class="card mb-3">
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
                                {{Str::limit($post['body'], 125, '')}}
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection