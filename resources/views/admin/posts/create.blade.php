@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('admin.posts.store') }}" method="post" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Titolo</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                <div class="invalid-feedback">
                    @error('title')
                        <ul>
                            @foreach ($errors->get('title') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}">
                <div class="invalid-feedback">
                    @error('slug')
                        <ul>
                            @foreach ($errors->get('slug') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Categoria</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == old('category_id')) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    @error('category_id')
                        <ul>
                            @foreach ($errors->get('category_id') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <h2>Tags</h2>
                @foreach ($tags as $tag)
                    <div class="form-check">
                        <input
                            id="tag-{{ $tag->id }}"
                            class="form-check-input"
                            type="checkbox"
                            value="{{ $tag->id }}"
                            name="tags[]"
                            @if (in_array($tag->id, old('tags', []))) checked @endif
                        >
                        <label class="form-check-label" for="tag-{{ $tag->id }}">
                            {{ $tag->name }}
                        </label>
                    </div>
                @endforeach
                @if ($errors->has('tags') || $errors->has('tags.*'))
                    <div>
                        Ci sono problemi con i tags
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">URL immagine</label>
                <input type="url" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}">
                <div class="invalid-feedback">
                    @error('image')
                        <ul>
                            @foreach ($errors->get('image') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="uploaded_img" class="form-label">Immagine</label>
                <input class="form-control @error('uploaded_img') is-invalid @enderror" type="file" id="uploaded_img" name="uploaded_img">
                <div class="invalid-feedback">
                    @error('uploaded_img')
                        <ul>
                            @foreach ($errors->get('uploaded_img') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content">{{ old('content') }}</textarea>
                <div class="invalid-feedback">
                    @error('content')
                        <ul>
                            @foreach ($errors->get('content') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="excerpt" class="form-label">Excerpt</label>
                <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt">{{ old('excerpt') }}</textarea>
                <div class="invalid-feedback">
                    @error('excerpt')
                        <ul>
                            @foreach ($errors->get('excerpt') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @enderror
                </div>
            </div>

            <div class="col-12">
                <button class="btn btn-primary" type="submit">Crea</button>
            </div>
        </form>
    </div>
@endsection
