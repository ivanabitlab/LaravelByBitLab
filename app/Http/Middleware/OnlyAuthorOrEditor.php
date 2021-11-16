<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlyAuthorOrEditor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $post = Post::find($request->segment(2));
        $currentUser = Auth::user();
        if ($post->user_id == $currentUser->id || $currentUser->hasPermissionTo('edit posts')) {
            return $next($request);
        }
        return redirect()->back();
    }
}
