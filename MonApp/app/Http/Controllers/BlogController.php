<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class BlogController extends Controller
{

    public function create() {
        return view('blog.create');
    }

    public function store(CreatePostRequest $request){
        $post = Post::create($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])
        ->with('success', 'Votre article a bien été sauvegardé');
    }


    public function edit(Post $post) {
        return view('blog.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post, CreatePostRequest $request){
        $post->update($request->validated());
        return redirect()->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])
        ->with('success', 'Votre article a bien été modifié');
    }


    public function index (): View {
        return view('blog.index', [
            'posts' => Post::paginate(1)
        ]);
    }

    public function show(string $slug, Post $post): RedirectResponse | View {
        if($post -> slug !== $slug){
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }
        return view("blog.show", [
            'post' => $post
        ]); 
    }



}
