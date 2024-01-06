<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class BlogController extends Controller
{

    public function index (): View {

        $validator = Validator::make([
            'title' => ''
        ], [
            'title' => 'required|min:8'
        ]);
        dd($validator->fails());

        return view('blog.index', [
            'posts' => Post::paginate(1)
        ]);
    }

    public function show(string $slug, string $id): RedirectResponse | View {
        $post = Post::findOrFail($id);
        // redirection automatique si le slug n'est pas correcte.
        if($post -> slug !== $slug){
            return to_route('blog.show', ['slug' => $post->slug, 'id' => $post->id]);
        }
        return view("blog.show", [
            'post' => $post
        ]); 
    }



}
