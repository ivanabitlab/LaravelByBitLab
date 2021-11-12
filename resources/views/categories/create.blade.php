@extends('layout.user-layout')
@section('title')
Nova kategorija
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Kreiraj kategoriju</div>

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
                <form action="/categories" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Ime</label>
                        <input type="text" name="title" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Opis</label>
                        <textarea name="description" cols="30" rows="10" class="form-control"></textarea>
                    </div>

                    <button type="submit" class="form-control btn btn-primary mt-2">Sačuvaj</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection