@extends('layouts/app', ['title' => 'Form Create'])

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
                    <div class="card-header">New Post</div>
                    <div class="card-body">
                        <form method="post" action="/post/store" enctype="multipart/form-data">
                            @csrf
                            @include('post.partials.form-control', ['submit' => 'Create'])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection