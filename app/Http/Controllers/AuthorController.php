<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function showAllAuthors(){
        return response()->json(Author::all());
    }

    public function showOneAuthor($author_id){
        try{
			$author = Author::findOrFail($author_id);
		}catch (ModelNotFoundException $e){
			return response('Autor não encontrado', 404);	
		}
        return response()->json($author, 200);
    }

    public function createAuthor(Request $request){
        $author = Author::create($request->all());

        return response()->json($author, 201);
    }

    public function updateAuthor($author_id, Request $request){
        try{
			$author = Author::findOrFail($author_id);
		}catch (ModelNotFoundException $e){
			return response('Autor não encontrado', 404);	
		}

        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function deleteAuthor($author_id){
        try{
			$author = Author::findOrFail($author_id);
		}catch (ModelNotFoundException $e){
			return response('Autor não encontrado', 404);	
        }
        
        $author->delete();

        return response('Deletado com sucesso', 200);
    }
}
