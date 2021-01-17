<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    //Stop unauthenticated users doing this
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store (Post $post, Request $request)
    {
        if ($post->likedBy($request->user())) {
            return response(null, 409);
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

        //Send mail only if a previous like hasnt been created (thanks to soft delete)
        if (!$post->likes()->onlyTrashed()->where('user_id', $request->user()->id)->count()) {
            Mail::to($post->user)->send(new PostLiked(auth()->user(),$post));

        }

        return back();
    } 

    public function destroy(Post $post, Request $request) 
    {
        //DELETE AND AUTH
        $request->user()->likes()->where('post_id', $post->id)->delete();

        return back();
    }
}
