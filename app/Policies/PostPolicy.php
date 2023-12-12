<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Post;

class PostPolicy
{
	public function before (User $user) {
		if($user->role === 'admin') return true;
	}
	public function create (User $user) {
		return true;
	}
    public function update (User $user, Post $post) 
	{
		return ($user->id == $post->user_id && now()->diffInHours($post->created_at) < 2 );
    }
    public function delete (User $user, Post $post) 
	{
        return ($user->id == $post->user_id && now()->diffInHours($post->created_at) < 2 );
    }
}
