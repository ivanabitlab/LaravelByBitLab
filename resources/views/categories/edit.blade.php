@extends('layout.user-layout')
@section('title')
Uredi kategoriju
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Izmeni kategoriju</div>
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
                <form action="/categories/{{$category->id}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Naslov</label>
                        <input type="text" name="title" class="form-control" value="{{$category->title}}">
                    </div>

                    <div class="form-group">
                        <label for="">Opis</label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control">{{$category->description}}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary form-control mt-2">Izmeni</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection