@extends('layout.user-layout')
@section('title')
Uredi članak
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Izmeni članak</div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card-body">
                <form action="/posts/{{$post->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Naslov</label>
                        <input type="text" name="title" class="form-control" value="{{$post->title}}">
                    </div>

                    <div class="form-group">
                        <label for="">Sadržaj</label>
                        <textarea name="body" id="" cols="30" rows="10" class="form-control">{{$post->body}}</textarea>
                    </div>

                    @can('edit posts')
                    <div class="form-group">
                        <label for="">Autor</label>
                        <select name="author" class="form-select">
                            @foreach($authors as $author)
                            <option value="{{$author->id}}" @if($post->user_id == $author->id)selected @endif >{{$author->username}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endcan
                    <div class="form-group">
                        <label for="">Naslovna fotografija</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    @if($categories->isNotEmpty())
                    <div class="form-group">
                        <label for="">Kategorija</label>
                        <select name="categories[]" class="form-select" size="3" multiple>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" @if($post->categories->contains($category))selected @endif >{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="">Vreme objavljivanja</label>
                        <input type="datetime-local" name="published_at" class="form-control" value="@if(isset($post->published_at)){{ date('Y-m-d\TH:i:s', strtotime($post->published_at)) }}@endif">
                    </div>

                    <button type="submit" class="btn btn-primary">Izmeni</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection