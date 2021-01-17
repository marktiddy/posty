<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function __construct()
    {
        //Only apply this to store and estroy
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index() 
    {
        //Grab our posts before passing into view. We user a paginate method but using get would get all
        //We use with so we dont make multiple queries
        $posts = Post::latest()->with(['user','likes'])->paginate(20);
        
        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post) 
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        //Create it through the user because the two tables are relational
        //Laravel automatically adds the user ID
         $request->user()->posts()->create(
            [ 'body' => $request->body]
         );

         //Redirect to posts
         return redirect()->route('posts');
    }

    public function destroy(Post $post) {
        //This refers to out PostPolicy which is implemented in AuthServiceProvider
        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }
}
