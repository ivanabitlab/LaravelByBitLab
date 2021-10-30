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

                    <div class="form-group">
                        <label for="">Naslovna fotografija</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Vreme objavljivanja</label>
                        <input type="datetime-local" name="published_at" class="form-control" value="{{ date('Y-m-d\TH:i:s', strtotime($post->published_at)) }}">
                    </div>

                    <button type="submit" class="btn btn-primary">Izmeni</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection