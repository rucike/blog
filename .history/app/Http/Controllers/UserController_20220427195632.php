<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Posts;
use App\Models\User;

class UserController extends Controller
{
    /*
    * Display active posts of a particular user
    * 
    * @param int $id
    * @return view
    */
    public function user_posts($id)
    {
        //
        $posts = Posts::where('author_id',$id)->where('active',1)->orderBy('created_at','desc')->paginate(5);
        $title = User::find($id)->name;
        return view('home')->withPosts($posts)->withTitle($title);
    }
    /*
    * Display all of the posts of a particular user
    * 
    * @param Request $request
    * @return view
    */
    public function user_posts_all(Request $request)
    {
        //
        $user = $request->user();
        $posts = Posts::where('author_id',$user->id)->orderBy('created_at','desc')->paginate(5);
        $title = $user->name;
        return view('home')->withPosts($posts)->withTitle($title);
    }
    /*
    * Display draft posts of a currently active user
    * 
    * @param Request $request
    * @return view
    */
    public function user_posts_draft(Request $request)
    {
        //
        $user = $request->user();
        $posts = Posts::where('author_id',$user->id)->where('active',0)->orderBy('created_at','desc')->paginate(5);
        $title = $user->name;
        return view('home')->withPosts($posts)->withTitle($title);
    }
    /**
     * profile for user
     */
    public function profile(Request $request, $id) 
    {
        $data['user'] = User::find($id);
        if (!$data['user'])
            return redirect('/home');
            if ($request -> user() && $data['user'] -> id == $request -> user() -> id) {
            $data['author'] = true;
        } else {
        $data['author'] = null;
        }

        $data['comments_count'] = $data['user'] -> comments -> count();
        $data['posts_count'] = $data['user'] -> posts -> count();
        $data['posts_active_count'] = $data['user'] -> posts -> where('active', '1') -> count();
        $data['posts_draft_count'] = $data['posts_count'] - $data['posts_active_count'];
        //$data['latest_posts'] = $data['user'] -> posts -> where('active', '1') -> take(5);
        //dd($data['latest_posts']);
        $data['latest_post'] = Posts::table('posts')
            -> orderBy('created_at', 'desc');
        dd($data['latest_post']);
        $data['latest_comments'] = $data['user'] -> comments -> take(5);
        return view('admin.profile', $data);
    }
}
