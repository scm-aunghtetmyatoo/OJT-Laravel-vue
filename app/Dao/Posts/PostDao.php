<?php

namespace App\Dao\Posts;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Dao\Posts\PostDaoInterface;

class PostDao implements PostDaoInterface
{
    /**
     * Go post list.
     *
     * @return void
     */
    public function getPostList()
    {
        // $posts = Post::orderBy('id', 'desc')->paginate(config('constants.paginate.post'));
        // $posts = Post::all(['id', 'title', 'description']);
        $posts = Post::orderBy('id', 'desc')->get();

        return $posts;
    }

    public function store($request){
        // $post = new Post;
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->status = 1;
        // $post->user_id = 1;
        // $post->save();
        $post = Post::create($request->post());

        return $post;
    }

    public function edit($request, $id)
    {
        $post = Post::find($id);
        return $post;
    }

    public function editConfirm($request, $id)
    {
        $post = Post::find($id);

        return $post;
    }

    public function update($request, $post)
    {
        // $post = Post::find($id);
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->status = $request->status;
        // $post->updated_user_id = auth()->user()->id;
        // $post->save();
        $post->fill($request->post())->save();


        return $post;
    }

    public function destroy($post)
    {
        // $post->deleted_user_id = Auth::user()->id;
        // $post->save();

        $post->delete();
        return $post;
    }

    public function search($request)
    {
        // Get the search value from the request
        $search = $request->search;
    
        // Search in the title and descroption columns from the posts table
        $posts = Post::query()
            ->where('title', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->paginate(2);
        return $posts;
    }

  }