@extends('layout.user-layout')
@section('title')
Korisnici CMSa
@endsection
@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-12">
                <br>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Ime</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Uloga</th>
                            <th>Broj članaka</th>
                            <th>Akcija</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td><a href="/users/{{$user->id}}">{{ $user->username }}</a></td>
                            <td>{{ $user->email }}</td>
                            <td>{{ empty($userRole=$user->roles->first())?"bez uloge":$userRole->name }}</td>
                            <td>{{ $user->posts_count}}</td>
                            <td>
                                @if($user->username !== "administrator")
                                <form action="/users/{{$user->id}}" method="post" class="d-inline">
                                    <div class="input-group">
                                        {{ csrf_field() }}
                                        @method('PATCH')
                                        <select class="form-control me-2" name="role">
                                            <option value="0">Bez uloge</option>
                                            @foreach($roles as $role)
                                            <option @if($userRole && $role->id == $userRole->id) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-primary btn-sm form-control" type="submit">Dodeli ulogu</button>
                                    </div>
                                </form>
                                @if(!$user->posts_count)
                                <form action="users/{{$user->id}}" method="post" class="d-inline">
                                    {{ csrf_field() }}
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm form-control mt-2" type="submit">Obriši</button>
                                </form>
                                @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{ $users->links() }}
@endsection