@extends('layout.user-layout')
@section('title')
@if($myPosts = Route::currentRouteName() == 'posts.index' )
Moji članci
@else
Svi članci
@endif

@endsection
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-12">
                @can('create posts')
                @if($myPosts)
                <a href="posts/create" class="btn btn-primary btn-sm mb-2">Novi post</a>
                <br>
                @endif
                @if($posts->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Naslov</th>
                            @if(!$myPosts)
                            <th>Autor</th>
                            @endif
                            <th>Kategorije</th>
                            <th>Objavljeno</th>
                            <th>Kreirano</th>
                            <th>Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>{{ $post->title }}</td>
                            @if(!$myPosts)
                            <td>{{ $post->user->username }}</td>
                            @endif
                            <td>
                                {{implode(', ',$post->categories->pluck('title')->toArray())}}
                            </td>
                            <td>{{ $post->published_at?date('d-m-Y', strtotime($post->published_at)):"nije postavljeno" }}</td>
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
                @else
                Nema postova za prikaz!
                @endif
                @else
                Dobro došli. Dok čekate da Vam administrator sajta odobri objavljivanje postova, pogledate <a href="/">članke</a> koji su vec na sajtu i ostavite svoj komentar.
                @endcan
            </div>
        </div>
    </div>
</div>
{{ $posts->links() }}
@endsection