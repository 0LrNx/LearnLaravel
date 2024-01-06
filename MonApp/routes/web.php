<?php

use App\Http\Controllers\BlogController;
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


Route::get('/', function () {
    return view('welcome');
});

/* UTILISATION D'UN PREFIX DANS LES ROUTES  */
Route::prefix('/blog')->name('blog.')->controller(BlogController::class)->group(function () {
    Route::get('/', 'index')->name('index');

    Route::get('/{slug}-{post}', 'show')->where([
        'post' => '[a-z0-9\-]+',
        'id' => '[0-9]+'
    ])-> name('show');
    
    /*
    Route::get('/{post:slug}', 'show')->where([
        'post' => '[a-z0-9\-]+',
    ])-> name('show');*/

});


