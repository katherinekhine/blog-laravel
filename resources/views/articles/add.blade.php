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

   <form method="POST">
    @csrf
    {{-- csrf pr ma laravel ka html mr work tl --}}
    <div class="mb-2">
        <label >Title</label>
        <input type="text" name="title" class="form-control">
    </div>
    <div class="mb-2">
        <label >Body</label>
        <textarea name="body" class="form-control"></textarea>
    </div>
    <div class="mb-2">
        <label >Category</label>
        <select name="category_id" class="form-control">
            <option value="1">News</option>
            <option value="2">Tech</option>
        </select>
    </div>

    <button class="btn btn-primary">Add Article</button>
   </form>
</div>
@endsection