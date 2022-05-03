<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Types;

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
      //paimami 5 paskutiniai irasai is DB (tik tiek kurie yra aktyvus)  
      $posts = Posts::where('active',1)->orderBy('created_at','desc')->paginate(5);
      $types = Types::all();
      $title = __('Latest Posts');
      //graziname home.blade.php faila is resources/views aplanko su reikiamais kintamaisiais
      return view('home')->withPosts($posts)->withTitle($title)->withTypes($types);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      //kuriame blog'u kurimo puslapi. Cia nusiuniami duomenys i create.blade.php
      $types = Types::all();
      if ($request->user()->can_post()) 
      {
        return view('posts.create')->withTypes($types);
      } 
      else 
      {
        $error = __('You have not sufficient permissions');
        return redirect('/home')->withErrors($error);
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostFormRequest $request)
    {
      //tikrinami duomenys ar visi yra ivesti
      $request->validate([
        'title' => 'required',
        'body' => 'required|min:5',
        'type' => 'required'
      ]);

      //paimami duomenys is lenteles ir irasomi i DB
      $post = new Posts();
      $post->title = $request->get('title');
      $post->body = $request->get('body');
      $post->slug = Str::slug($post->title);

      $type = $request->get('type');
      $post->type_id = $type;

      //tikrinama ar nera vienodu irasu pavadinimu
      $duplicate = Posts::where('slug', $post->slug)->first();
      if ($duplicate) 
      {
        $message = __('Title already exists');
        return redirect('new-post')->withMessage($message)->withInput();
      }

      //tikrinama, kuria informacija perduoti zinutei (a)
      $post->author_id = $request->user()->id;
      if ($request->has('save')) 
      {
        $post->active = 0;
        $message = __('Post saved successfully');
      } 
      else 
      {
        $post->active = 1;
        $message = __('Post published successfully');
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
    public function show($slug)
    {
        $post = Posts::where('slug',$slug)->first();
        $select = Types::where('id', $post->type_id)->first();
        if(!$post)
        {
          $error = __('Page does not exist');
          return redirect('/home')->withErrors($error);
        }
        $comments = $post->comments;

        return view('posts.show')->withPost($post)->withComments($comments)->with('select', $select->type);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $slug)
    {
        $types = Types::all();
        $post = Posts::where('slug',$slug)->first();
        $select = Types::where('id', $post->type_id)->first();
        if($post && ($request->user()->id == $post->author_id || $request->user()->is_admin()))
        return view('posts.edit')->with('post',$post)->with('types', $types)->with('select', $select->type);
        $error = __('You have not sufficient permissions');
        return redirect('/home')->withErrors($error);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostsRequest  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $post_id = $request->input('post_id');
      $post = Posts::find($post_id);
      if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
        $title = $request->input('title');
        $slug = Str::slug($title);
        $duplicate = Posts::where('slug', $slug)->first();
        if ($duplicate) {
          if ($duplicate->id != $post_id) {
            $message = __('Title already exists');
            return redirect('edit/' . $post->slug)->withErrors($message)->withInput();
          } else {
            $post->slug = $slug;
          }
        }
  
        $post->title = $title;
        $post->body = $request->input('body');
        $post->type_id = $request->get('type');
  
        if ($request->has('save')) {
          $post->active = 0;
          $message = __('Post saved successfully');
          $landing = 'edit/' . $post->slug;
        } else {
          $post->active = 1;
          $message = __('Post updated successfully');
          $landing = $post->slug;
        }
        $post->save();
        return redirect($landing)->withMessage($message);
      } else {
        $error = __('You have not sufficient permissions');
        return redirect('/home')->withErrors($error);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Posts::find($id);
        if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
        {
        $post->delete();
        $data['message'] = __('Post deleted Successfully');
        }
        else 
        {
        $data['errors'] = __('Error').". ".__('You have not sufficient permissions');
        }
        return redirect('/home')->with($data);
    }
}
