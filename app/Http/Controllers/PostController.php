<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Requests\Post\UpdateRequest;

use App\Imports\PostsImport;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    public function index()
	{
		$posts = Post::all();
		foreach($posts as $post)
		{
			$post->canDelete = auth()->user() ? auth()->user()->can('delete', $post) : false;
			$post->canUpdate = auth()->user() ? auth()->user()->can('update', $post) : false;
		}
		return inertia('Post/Index', compact('posts'));
	}
	
	public function create()
	{
		return inertia('Post/Create');
	}
	
	public function store(StoreRequest $request)
	{
		$data = $request->validated();
		$data['viewer'] = 0;
		$data['user_id'] = auth()->user() === null ? 2 : auth()->user()->id; // id=1 - admin, id=2 - guest
		$data['title'] = 'test';
		$data['image'] = 'test';
		$data['preview'] = 'test';
		Post::create($data);
		return redirect()->route('post.index');
	}
	
	public function edit(Post $post)
	{
		return inertia('Post/Update', compact('post'));
	}
	
	public function update(Post $post, UpdateRequest $request)
	{
		$post->update($request->validated());
		return redirect()->route('post.index');
	}
	
	public function destroy(Post $post)
	{
		$post->delete();
		return redirect()->route('post.index');
	}
	
	public function import()
	{
		Excel::import(new PostsImport, storage_path('posts.xlsx'));
        
        return redirect()->route('post.index');
	}
}
