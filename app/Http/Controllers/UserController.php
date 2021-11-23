<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
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
        $users = User::withCount('posts')->simplePaginate(10);
        $roles = Role::all();
        return view('user.index', compact('users', 'roles'));
    }

    public function show(User $user, Request $request)
    {
        $posts = Post::where('user_id',$user->id)->where('title','LIKE','%'.$request->search.'%')
        ->where('published_at', '<=', Carbon::now()->toDateTimeString())
        ->orderBy('published_at','desc')->paginate(9);
        
        $categories = Category::has('posts')->get();
        $authors = User::has('posts')->get();
        return view('blog.home', compact('user','posts','categories','authors'));
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
