<?php

use App\Models\PostImage;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('teste', function () {
    return 'Ola';
});

Route::get('sub', function() {
    $post = Post::select('id','title')
        ->addSelect([
        'thumb' => PostImage::selectRaw('COUNT(*) as t')
                    ->whereColumn('post_id', 'posts.id')
                    ->limit(1)
    ])->where('id', 292)
    ->get();

    return $post;
});
