<?php

use App\Models\PostImage;
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

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

/*
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

Route::get('email', function () {
    try {
        // return new \App\Mail\MensagemTesteMail();
        Mail::send(new \App\Mail\MensagemTesteMail());
        return 'Email enviado com sucesso';
    } catch (\Exception $e) {
        return $e->getMessage();
    }
});
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/marcas', function () {
    return view ('app.marcas');
})->name('marcas')->middleware('auth');
