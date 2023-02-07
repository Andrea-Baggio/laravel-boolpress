@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $category->name }}</h1>
        <p>
            {{ $category->description }}
        </p>

        <h2>Post associati</h2>
        <div class="row g-3">
            @foreach ($posts as $post)
                <div class="col-sm-6 col-md-4">
                    <div class="card h-100">
                        <img src="{{ asset($post->uploaded_img ? "storage/{$post->uploaded_img}" : "storage/placeholder.jpg") }}" class="card-img-top" alt="{{ $post->title }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text flex-grow-1">{{ $post->excerpt }}</p>
                            <a href="{{ route('admin.posts.show', ['post' => $post]) }}" class="btn btn-primary">Leggi</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
