<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('home');
});

Route::get('/', [PostsController::class,'index']);
Route::get('/home', ['as' => 'home', 'uses' => [PostsController::class,'index']]);

require __DIR__.'/auth.php';

// check for logged in user
Route::middleware(['auth'])->group(function () {
    // show new post form
    Route::get('new-post', [PostsController::class, 'create'])->name('new-post');
    // save new post
    Route::post('new-post', [PostsController::class, 'store']);
    // edit post form
    Route::get('edit/{slug}', [PostsController::class, 'edit']);
    // update post
    Route::post('update', [PostsController::class, 'update']);
    // delete post
    Route::get('delete/{id}', [PostsController::class, 'destroy']);
    // display user's all posts
    Route::get('my-all-posts', 'UserController@user_posts_all')->name('my-all-posts');
    // display user's drafts
    Route::get('my-drafts', 'UserController@user_posts_draft');
    // add comment
    Route::post('comment/add', 'CommentController@store');
    // delete comment
    Route::post('comment/delete/{id}', 'CommentController@distroy');
  });
  
  //users profile
  Route::get('user/{id}', 'UserController@profile')->where('id', '[0-9]+')->name('user/'.Auth::id());
  // display list of posts
  Route::get('user/{id}/posts', 'UserController@user_posts')->where('id', '[0-9]+');
  // display single post
  Route::get('/{slug}', ['as' => 'post', 'uses' => 'PostsController@show'])->where('slug', '[A-Za-z0-9-_]+');
 //Route::get('/{slug}', [PostsController::class, 'show'])->where('slug', '[A-Za-z0-9-_]+');