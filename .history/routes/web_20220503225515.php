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

Route::get('/', [PostsController::class,'index'])->name('home');
Route::get('/home', [PostsController::class,'index'])->name('home');
require __DIR__.'/auth.php';

// apimama visi route, kad butu tikrinama ar vartotojas yra prisijunges
Route::middleware(['auth'])->group(function () {
    // rodoma naujo iraso kurimo formas
    Route::get('new-post', [PostsController::class, 'create'])->name('new-post');
    // issaugojamas naujas irasas
    Route::post('new-post', [PostsController::class, 'store']);
    // redaguojamo iraso forma
    Route::get('edit/{slug}', [PostsController::class, 'edit']);
    // atnaujinamas irasas
    Route::post('update', [PostsController::class, 'update']);
    // istrinamas irasas
    Route::get('delete/{id}', [PostsController::class, 'destroy']);
    // rodomi visi vartotojo irasai
    Route::get('my-all-posts', [UserController::class, 'user_posts_all'])->name('my-all-posts');
    // rodomi visi vartotojo juodrasciai
    Route::get('my-drafts', [UserController::class, 'user_posts_draft']);
    // irasomas komentaras
    Route::post('comment/add', [CommentsController::class, 'store']);
    // delete comment
    Route::post('comment/delete/{id}', [CommentsController::class, 'distroy']);
  });
  
  // vartotojo profilis
  Route::get('user/{id}', [UserController::class, 'profile'])->where('id', '[0-9]+')->name('user/'.Auth::id());
  // display list of posts
  Route::get('user/{id}/posts', [UserController::class, 'user_posts'])->where('id', '[0-9]+');
  // display single post
  //Route::get('/{slug}', ['as' => 'post', 'uses' => 'PostsController@show'])->where('slug', '[A-Za-z0-9-_]+');
 Route::get('/{slug}', [PostsController::class, 'show'])->where('slug', '[A-Za-z0-9-_]+');