@extends('layout.user-layout')
@section('title')
Novi članak
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Kreiraj članak</div>

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
                <form action="/posts" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Naslov</label>
                        <input type="text" name="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Sadržaj</label>
                        <textarea name="body" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Naslovna fotografija</label>
                        <input type="file" name="image" class="form-control">
                    </div>

                    @if($categories->isNotEmpty())
                    <div class="form-group">
                        <label for="">Kategorija</label>
                        <select name="categories[]" class="form-select" size="3" multiple>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" >{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="form-group">
                        <label for="">Vreme objavljivanja</label>
                        <input type="datetime-local" name="published_at" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary form-control mt-2">Sačuvaj</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection