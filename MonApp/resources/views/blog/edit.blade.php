@extends('base')

@section('title', 'Modifier un article')


@section('content')
    <form action="" method="post" class="vstack gap-2">
        @csrf
        <div>
            <input type="text" name="title" value="Article de démonstration">
            @error("title")
                {{ $message }}
            @enderror
        </div>
        
        <div>
            <textarea name="content">Contenu de démonstration</textarea>
            @error("content")
                {{ $message }}
            @enderror
        </div>
        
        <button>Enregistrer</button>
    </form>
@endsection