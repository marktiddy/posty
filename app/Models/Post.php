<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['body'];

    //Check for duplicate likes
    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id); //Laravel collection method
    }

    //Reverse relationship so we can get user details from a post
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
