<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:edit users')->except('show');
    }

    public function index()
    {
        $users = User::withCount('posts')->get();
        $roles = Role::all();
        return view('user.index', compact('users', 'roles'));
    }

    public function show(User $user)
    {
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }

    public function changeRole(User $user, Request $request)
    {
        $user->syncRoles($request->role);
        return redirect()->back();
    }
}
