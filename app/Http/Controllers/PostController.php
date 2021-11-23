<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('index','allPostsForEditors');
        $this->middleware('permission:create posts')->only(['create', 'store']);
        $this->middleware('author.or.editor')->only(['edit', 'update', 'destroy']);
    }

    public function blog(Request $request)
    {
        $posts = Post::where('title','LIKE','%'.$request->search.'%')
        ->where('published_at', '<=', Carbon::now()->toDateTimeString())
        ->orderBy('published_at','desc')->paginate(9);
  
        $categories = Category::has('posts')->get();
        $authors = User::has('posts')->get();
        return view('blog.home', compact('posts','categories','authors'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::user()->posts()->simplePaginate(10);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = $request->file('image')->store('featured_images', 'public');
        $post = new Post();
        $post->user_id = auth()->id();
        $post->title = $request->title;
        $post->body = $request->body;
        $post->featured_image = $path;
        $post->published_at = $request->published_at;
        $post->save();
        $post->categories()->attach($request->categories);

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('blog.post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $authors = User::permission('create posts')->get();
        return view('posts.edit', compact('post', 'categories','authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        if (isset($request->image)) {
            Storage::delete('public/' . $post->featured_image);
            $path = $request->file('image')->store('featured_images', 'public');
            $post->featured_image = $path;
        }
        $post->title = $request->title;
        $post->body = $request->body;
        $post->published_at = $request->published_at;
        if(isset($request->author)){
            $post->user_id = $request->author;
        }
        $post->save();
        $post->categories()->sync($request->categories);
        
        //postavlja poruku koja vazi samo 1 request, osim ako se ne obnovi (flash i with rade isto)
        //$request->session()->flash('success','Uspešno ste izmenili članak');
        return redirect()->back()->with('success', 'Uspešno ste izmenili članak');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::delete('public/' . $post->featured_image);
        $post->delete();
        return redirect()->back();
    }

    public function allPostsForEditors()
    {
        $posts = Post::where('user_id', '!=', Auth::user()->id)->orderBy('published_at','desc')->simplePaginate(10);
        return view('posts.index', compact('posts'));
    }
}
