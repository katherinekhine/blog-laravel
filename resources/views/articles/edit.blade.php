@extends("layouts.app")

@section("content")

<div class="container" style="max-width: 800px">

    @if($errors->any())
    <div class="alert alert-warning">
        @foreach($errors->all() as $err )
        {{ $err }}
        @endforeach
    </div>
    @endif

    <h2>Edited your article</h2>

    <form method="POST" action="{{ url("/articles/update/$article->id") }}">
        @csrf
        @method("PUT")
        {{-- csrf pr ma laravel ka html mr work tl --}}
        <div class="mb-2">
            <label>Title</label>
            <input value="{{ $article->title }}" type="text" name="title" class="form-control">
        </div>
        <div class=" mb-2">
            <label>Body</label>
            <textarea name="body" class="form-control">{{ $article->body }}</textarea>
        </div>
        <div class="mb-2">
            <label>Category</label>
            <select name="category_id" class="form-control">
                <option value="1" {{ $article->category_id == 1 ? 'selected' : '' }}>News</option>
                <option value="2" {{ $article->category_id == 2 ? 'selected' : '' }}>Tech</option>
            </select>
        </div>

        <button class="btn btn-primary">Edit</button>
    </form>
</div>
@endsection