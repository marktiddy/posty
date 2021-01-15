<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() 
    {
        //Grab our posts before passing into view. We user a paginate method but using get would get all
        $posts = Post::paginate(20);
        
        return view('posts.index', [
            'posts' => $posts
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
}
