<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{
    public function showAllGenres(){
        return response()->json(Genre::all());
    }

    public function showOneGenre($genre_id){
		try{
			$genre = Genre::findOrFail($genre_id);
		}catch (ModelNotFoundException $e){
			return response('Genero não encontrado', 404);	
		}
        return response()->json($genre, 200);
    }

    public function createGenre(Request $request){
        $genre = Genre::create($request->all());

        return response()->json($genre, 201);
    }

    public function updateGenre($genre_id, Request $request){
        try{
			$genre = Genre::findOrFail($genre_id);
		}catch (ModelNotFoundException $e){
			return response('Genero não encontrado', 404);	
		}

        $genre->update($request->all());

        return response()->json($genre, 200);
    }

    public function deleteGenre($genre_id){
        try{
			$genre = Genre::findOrFail($genre_id);
		}catch (ModelNotFoundException $e){
			return response('Genero não encontrado', 404);	
        }
        
        $genre->delete();

        return response('Deletado com sucesso', 200);
	}
	
	public function showAllBooksFromGenre($genre_id){
		try{
			$genre = Genre::findOrFail($genre_id);
		}catch (ModelNotFoundException $e){
			return response('Livro não encontrado', 404);	
		}

		$books = $genre->books;

		return response()->json($books, 200);
	}
}
