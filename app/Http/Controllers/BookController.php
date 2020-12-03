<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class BookController extends Controller
{
	public function showAllBooks(){
		$books = Book::all();

		return response()->json($books, 200);
	}

	public function showAllBooksFromAuthor($author_id){
		try{
			$author = Author::findOrFail($author_id);
		}catch (ModelNotFoundException $e){
			return response('Autor não encontrado', 404);	
		}

		$books = $author->books;

		return response()->json($books, 200);
	}

	public function showOneBook($author_id, $book_id){
		try{
			$author = Author::findOrFail($author_id);
		}catch (ModelNotFoundException $e){
			return response('Autor não encontrado', 404);	
		}

		$book = $author->books
				->where('id', $book_id)
				->first();
		
		return response()->json($book, 200);
	}

	public function createBook($author_id, Request $request){
		try{
			$author = Author::findOrFail($author_id);
		}catch (ModelNotFoundException $e){
			return response('Autor não encontrado', 404);	
		}

		$book = Book::create([
			'title' => $request->title,
			'author_id' => $author->id
		]);

		return response()->json($book, 201);
	}

	public function updateBook($author_id, $book_id, Request $request){
		try{
			$author = Author::findOrFail($author_id);
		}catch (ModelNotFoundException $e){
			return response('Autor não encontrado', 404);	
		}

		$book = $author->books
			->where('id', $book_id)
			->first()
			->update($request->all());

		$updatedBook = Book::find($book_id);

		return response()->json($updatedBook, 200);
	}

	public function deleteBook($author_id, $book_id){
		try{
			$author = Author::findOrFail($author_id);
		}catch (ModelNotFoundException $e){
			return response('Autor não encontrado', 404);	
		}

		$book = $author->books
			->where('id', $book_id)
			->first()
			->delete();

		return response()->json('Livro deletado com sucesso', 200);
	}

	public function addGenre($book_id, $genre_id){
		try{
			$book = Book::findOrFail($book_id);
		}catch (ModelNotFoundException $e){
			return response('Livro não encontrado', 404);	
		}

		$book->genres()->attach($genre_id);

		return response()->json('Genero adicionado com sucesso', 200);
	}

	public function removeGenre($book_id, $genre_id){
		try{
			$book = Book::findOrFail($book_id);
		}catch (ModelNotFoundException $e){
			return response('Livro não encontrado', 404);	
		}

		$book->genres()->detach($genre_id);

		return response()->json('Genero removido com sucesso', 200);
	}

	public function showAllGenresFromBook($book_id){
		try{
			$book = Book::findOrFail($book_id);
		}catch (ModelNotFoundException $e){
			return response('Livro não encontrado', 404);	
		}

		$genres = $book->genres;

		return response()->json($genres, 200);
	}

}
