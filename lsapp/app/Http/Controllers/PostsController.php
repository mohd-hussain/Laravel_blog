<?php

namespace App\Http\Controllers;

use App\Post;       //for post model
use DB;             //for run sql query

use Illuminate\Http\Request;

class PostsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['index','show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::all();
        // return Post:: where('title','Post Two') ->get();
        // $posts = DB::select('SELECT * FROM posts');

        // $posts = Post::orderBy('title','desc')->take(1)->get();
        // $posts = Post::orderBy('title','desc')->get();

        $posts = Post::orderBy('created_at','desc')->paginate();
        return view('posts.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('$request->title','$request->body');
        
        $this->validate($request,[
            'title' => 'required|max:255',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999',
        ]);

        //Handle File Upload
        if($request->hasFile('cover_image')){
            //Get filename with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //Get Just filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            //Get just Ext
            $extention = $request->file('cover_image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extention;
            //Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        }else{
            $fileNameToStore = 'noimage.jpg';
        }
        
        $post = new Post();
        $post->title = request('title');
        $post->body = request('body');
        $post->user_id= auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success','Post Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post= Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post= Post::find($id);
        
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorised Page');
        }

        return view('posts.edit')->with('post',$post);
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
        $this->validate($request,[
            'title' => 'required|max:255',
            'body' => 'required',
        ]);
        
        $post = Post::find($id);
 
        $post->title = request('title');
        $post->body = request('body');
 
        $post->save();

        return redirect('/posts')->with('success','Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorised Page');
        }

        $post->delete();
        return redirect('/posts')->with('success','Post Deleted Succesfully');
    }
}
