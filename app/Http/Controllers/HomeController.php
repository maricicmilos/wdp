<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Reply;
use App\Post;
use App\Comment;
use App\Http\Requests\CreateHomeCommentRequest;
use App\Http\Requests\CreateHomeReplyRequest;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /* public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function post($id){
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', '=', $post->id)
        ->where('is_active', '=', 1)->get();
        
        return view('/post', compact('post', 'comments'));
    }

    public function posts(){
        $posts = Post::all();
        return view('/posts', compact('posts'));
    }

    public function createComment(CreateHomeCommentRequest $request){

        $user = Auth::user();

        $post = Comment::create([
            'user_id' => $user->id,
            'post_id' => $request->post_id,
            'email' => $user->email,
            'body' => $request->body
        ]);

        return redirect()->to(url()->previous() . '#comment')->with('create_comment_message', 'Your Comment is waiting to be moderated.');
        
    }

    public function createReply(CreateHomeReplyRequest $request){

        $user = Auth::user();

        Reply::create([
            'user_id' => $user->id,
            'comment_id' => $request->comment_id,
            'email' => $user->email,
            'body' => $request->reply_body
        ]);

        return redirect()->to(url()->previous() . "#comment" . $request->comment_id)->with('create_reply_message', 'Your Reply is waiting to be moderated.');

    }

    public function profile($id){

        $user = Auth::user();
        
        return view('/profile', compact('user'));
    }
}
