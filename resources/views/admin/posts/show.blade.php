@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $post->title }}</h1>
        @if ($post->category)
            <h2>
                Nella categoria: <a href="{{ route('admin.categories.show', ['category' => $post->category]) }}">{{ $post->category->name }}</a>
            </h2>
        @endif

        @if ($post->tags->all())
            <div>
                @foreach ($post->tags as $tag)
                    <a href="{{ route('admin.tags.show', ['tag' => $tag]) }}">{{ $tag->name }}</a>{{ $loop->last ? '' : ', ' }}
                @endforeach
            </div>
        @endif

        {{-- <img src="{{ $post->image }}" alt="{{ $post->title }}"> --}}
        <div class="clearfix">
            <img class="float-start" src="{{ asset('storage/' . $post->uploaded_img) }}" alt="{{ $post->title }}">
            {{ $post->content }}
        </div>
    </div>
@endsection
