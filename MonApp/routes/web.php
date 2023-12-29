<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/* UTILISATION D'UN PREFIX DANS LES ROUTES  */

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/blog')->name('blog.')->group(function () {
    Route::get('/', function (Request $request) {

        /* === ORM ELOQUENT === */

        //$posts = Post::paginate(1, ['id', 'title']);
        /*$post = Post::create([
            'title' => 'Mon nouveau titre',
            'slug' => 'nouveau-titre-test',
            'content' => 'Nouveau contenu'
        ]);

        dd($post);
        return $post;*/

        return $post = Post::paginate(25);

        /*
        return [
            "link" => \route('blog.show', ['slug' => 'article', 'id' => 13]),
        ];*/
    })->name('index');

    Route::get('/{slug}-{id}', function (string $slug, string $id,Request $request) {
        $post = Post::findOrFail($id);
        // redirection automatique si le slug n'est pas correcte.
        if($post -> slug !== $slug){
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }
        return $post;
        /*return [
            'slug' => $slug,
            'id' => $id,
            'name' => $request->input('name')
        ];*/
    })->where([
        'slug' => '[a-z0-9\-]+',
        'id' => '[0-9]+'
    ])-> name('show');
});
    


/*

APPRENTISSAGE DES ROUTES

Route::get('/blog', function (Request $request) {
    return [
        "link" => \route('blog.show', ['slug' => 'article', 'id' => 13]),
    ];
})-> name('blog.index');


// http://localhost:8000/blog/test-de-mon-blog-1?name=John
Route::get('/blog/{slug}/{id}', function (string $slug, string $id,Request $request) {
    return [
        'slug' => $slug,
        'id' => $id,
        'name' => $request->input('name')
    ];
})->where([
    'slug' => '[a-z0-9\-]+',
    'id' => '[0-9]+'
])-> name('blog.show');
*/


