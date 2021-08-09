<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
use Maatwebsite\Excel\Facades\Excel;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id', 'desc')->paginate(config('constants.paginate.post'));

        return view('posts.index',compact('posts'));
    }

    public function search(Request $request){
        // Get the search value from the request
        $search = $request->search;
    
        // Search in the title and descroption columns from the posts table
        $posts = Post::query()
            ->where('title', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%")
            ->paginate(2);
    
        // Return the search view with the resluts compacted
        return view('posts.index', compact('posts'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $title = $request->title;
        $description = $request->description;
        return view('posts.create', compact('title', 'description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'title' => ['required','unique:posts'],
            'description' => 'required',
        ]);

        $title = $request->title;
        $description = $request->description;

        return view('posts.confirm',compact('title','description'));
    }
    public function store(Request $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->status = 1;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('posts.index')->with('success','Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $post = Post::find($id);
        if(count($request->all()) > 0) {
            $title = $request->title;
            $description = $request->description;
            if($request->get('status') == null){
                $status = 0;
            }
            else{
                $status = $request->status;
            }
            return view('posts.edit', compact('post','title', 'description', 'status'));
        } else {
            $title = $post->title;
            $description = $post->description;
            $status = $post->status;
            return view('posts.edit',compact('post','title', 'description', 'status'));
        }
    }
    public function editconfirm(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:posts,title,'.$id,
            'description' => 'required',
            'status' => 'boolean|nullable',
        ]);

        $post = Post::find($id);
        $title = $request->title;
        $description = $request->description;
        if($request->get('status') == null){
            $status = 0;
        }
        else{
            $status = $request->status;
        }
        return view('posts.editconfirm',compact('post','title','description','status'));
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
        $post->update($request->all());

        return redirect()->route('posts.index')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

         return redirect()->route('posts.index')->with('success','post deleted successfully');
    }

    public function export() 
    {
        return Excel::download(new PostsExport, 'posts.xlsx');
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function import(Post $post) 
    {
        Excel::import(new PostsImport,request()->file('file'));
           
        return redirect()->route('posts.index')->with('success','Import Process successfully');
    }
    public function upload()
    {
        return view('posts.upload');
    }

}
