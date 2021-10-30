@extends('layout.user-layout')
@section('title')
Svi članci
@endsection
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="posts/create" class="btn btn-primary btn-sm mb-2">Novi post</a>
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Naslov</th>
                            <th>Kreirano</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            <td>{{ date('d-m-Y', strtotime($post->created_at)) }}</td>
                            <td>
                                <a href="posts/{{$post->id}}" class="btn btn-primary btn-sm">Prikaži</a>
                                <a href="posts/{{$post->id}}/edit" class="btn btn-primary btn-sm">Izmeni</a>
                                <form action="posts/{{$post->id}}" method="post" class="d-inline">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Obriši</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection