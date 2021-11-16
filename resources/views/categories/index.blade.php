@extends('layout.user-layout')
@section('title')
Sve kategorije
@endsection
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-12">
                <a href="categories/create" class="btn btn-primary btn-sm mb-2">Nova kategorija</a>
                <br>
                @if($categories->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Ime</th>
                            <th>Broj postova u kategoriji</th>
                            <th> Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->loadCount('posts')->posts_count}}</td>
                            <td>
                                <a href="categories/{{$category->id}}" class="btn btn-primary btn-sm">Prikaži sve postove iz ove kategorije</a>
                                <a href="categories/{{$category->id}}/edit" class="btn btn-primary btn-sm">Izmeni</a>
                                <form action="categories/{{$category->id}}" method="post" class="d-inline">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Obriši</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                Još uvek nema kategorija!
                @endif
            </div>
        </div>
    </div>
</div>
@endsection