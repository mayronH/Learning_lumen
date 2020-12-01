<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function showAllAuthors(){
        return response()->json(Author::all());
    }

    public function showOneAuthor($author_id){
        return response()->json(Author::find($author_id));
    }

    public function createAuthor(Request $request){
        $author = Author::create($request->all());

        return response()->json($author, 201);
    }

    public function updateAuthor($author_id, Request $request){
        $author = Author::findorFail($author_id);
        $author->update($request->all());

        return response()->json($author, 200);
    }

    public function deleteAuthor($author_id){
        Author::findorFail($author_id)->delete();

        return response('Deletado com sucesso', 200);
    }

    public function createBooks(Request $request){

    }
}
