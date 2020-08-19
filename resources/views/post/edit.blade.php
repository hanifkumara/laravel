@extends('layouts/app', ['title' => 'Update Post'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{session()->get('success')}}
                        </div>
                    @endif
                <div class="card">
                <div class="card-header">Update Post : {{$post->title}}</div>
                    <div class="card-body">
                        <form method="post" action="/post/{{$post->slug}}/edit" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            @include('post.partials.form-control')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection