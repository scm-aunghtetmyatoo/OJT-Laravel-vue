<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Contracts\Services\Posts\PostServiceInterface;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->getPostList();

        return response()->json($posts);
    }

    public function search(Request $request){

        $posts=$this->postService->search($request);

    
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
        $posts = $this->postService->store($request);

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
        $post = $this->postService->edit($request, $id);
        if(count($request->all()) > 0) {
            $title = $request->title;
            $description = $request->description;
            if($request->get('status') == null){
                $status = 0;
            }
            else{
                $status = $request->status;
            }
        } else {
            $title = $post->title;
            $description = $post->description;
            $status = $post->status;
        }
        return view('posts.edit', compact('post','title', 'description', 'status'));
    }
    public function editconfirm(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|unique:posts,title,'.$id,
            'description' => 'required',
            'status' => 'boolean|nullable',
        ]);

        $post=$this->postService->editConfirm($request, $id);

        $title = $request->title;
        $description = $request->description;
        if($request->get('status') == null){
            $status = 0;
        }
        else{
            $status = $request->status;
        }
        return view('posts.editconfirm', compact('post','title','description','status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post=$this->postService->update($request, $id);

        return redirect()->route('posts.index')->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=$this->postService->destroy($id);

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
