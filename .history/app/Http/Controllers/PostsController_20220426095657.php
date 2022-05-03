<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

//use App\Posts;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fetch 5 posts from database which are active and latest
      $posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate(5);
      //page heading
      $title = 'Latest Posts';
      //return home.blade.php template from resources/views folder
      return view('home')->withPosts($posts)->withTitle($title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
      if ($request->user()->can_post()) {
        return view('posts.create');
      } else {
        return redirect('/')->withErrors('You have not sufficient permissions for writing post');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostsRequest $request)
    {
        $post = new Posts();
        $post->title = $request->get('title');
        $post->body = $request->get('body');
        $post->slug = Str::slug($post->title);

        $duplicate = Posts::where('slug', $post->slug)->first();
        if ($duplicate) {
        return redirect('new-post')->withErrors('Title already exists.')->withInput();
        }

        $post->author_id = $request->user()->id;
        if ($request->has('save')) {
        $post->active = 0;
        $message = 'Post saved successfully';
        } else {
        $post->active = 1;
        $message = 'Post published successfully';
        }
        $post->save();
        return redirect('edit/' . $post->slug)->withMessage($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        $post = Posts::where('slug',$slug)->first();
        if(!$post)
        {
        return redirect('/')->withErrors('requested page not found');
        }
        $comments = $post->comments;
        return view('posts.show')->withPost($post)->withComments($comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts)
    {
        $post = Posts::where('slug',$slug)->first();
        if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
        return view('posts.edit')->with('post',$post);
        return redirect('/')->withErrors('you have not sufficient permissions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostsRequest  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts)
    {
        //
    }
}
