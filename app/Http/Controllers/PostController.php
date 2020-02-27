<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Category;
use App\Photo;
use App\Http\Requests\CreatePostsRequest;
use Carbon\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {                
        $image = $request->photo;
        $image_name = Carbon::now()->timestamp . '.' . $image->extension();
        $image->move(public_path(). '\images\\posts',   $image_name);

        $photo = Photo::create([
            'path' => $image_name
        ]);

        $post = Post::create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'photo_id' => $photo->id,
            'title' => $request->title,
            'body' => $request->body
        ]);

        return redirect('admin/posts'); 

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
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all()->pluck('name', 'id');

        return view('admin.posts.edit', compact('post', 'categories'));
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
        $post = Post::findOrFail($id);
        $photo = $post->photo;

        if(isset($request->photo)){
            unlink(public_path() . $request->cur_photo);
            $image = $request->photo;
            $image_name = Carbon::now()->timestamp . '.' . $image->extension();
            $image->move(public_path() .'\images\\posts', $image_name);
            
           
            $updated = $post->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'body' => $request->body
            ]);

            $photo->path = $image_name;
            $photo->save();

        } else {
            $updated = $post->update([
                'category_id' => $request->category_id,
                'title' => $request->title,
                'body' => $request->body
            ]);
        }

        return redirect('admin/posts');        

        /* return $request; */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = Post::destroy($id);

        $deleted ? $msg = 'Record succesfully deleted' : $msg = 'Error occured';

        return redirect('admin/posts')->with('msg', $msg);
    }
}
