<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookAuthor;
use Illuminate\Support\Facades\Validator;

use Exception;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    protected $book;
    protected $bookAuthor;

    public function __construct()
    {
        $this->book         = new Book();
        $this->bookAuthor   = new BookAuthor();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = $this->book->all();
        
        return response()->json($books, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            
            // Validating book information
            $validator1 = Validator::make($request->all(), $this->book->rules(), $this->book->feedback());

            if($validator1->fails()) {
                return response()->json(['errors' => $validator1->errors()], 422);
            }

            // Validating author information related to the book
            $books_authors = $request->all('authors_id');

            $validator2 = Validator::make($books_authors, [
                'authors_id' => 'required|array'
            ]);

            if($validator2->fails()) {
                return response()->json(['errors' => $validator2->errors()], 422);
            }

            $book = $this->book->create($request->all());

            // Cadastrando o relacionamento entre livro e autores
            if(!$book) {
                throw new Exception('Erro ao cadastrar o livro');
            }

            // Registering authors related to the book
            foreach($books_authors['authors_id'] as $author) {

                $this->bookAuthor->create([
                    'book_id'   => $book['id'],
                    'author_id' => $author 
                ]);
            }

            $book['authors'] = $this->bookAuthor->returnAuthorsBook($book['id']);

            $response   = $book;
            $code       = 201;

        } catch (\Throwable $th) {
            
            $response = [
                'message'   => $th->getMessage(),
                'error'     => true
            ];

            $code = 500;

        }

        return response()->json($response, $code);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = $this->book->find($id);

        if($book === null) {
            return response()->json(['erro' => 'Livro não encontrado com o código informado'], 404);
        }

        $book['authors'] = $this->bookAuthor->returnAuthorsBook($book['id']);

        return response()->json($book, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $book = $this->book->find($id);

        if($book === null) {
            return response()->json(['erro' => 'Não foi possível realizar a alteração, pois o livro solicitado não existe'], 404);
        }

        // Validating book information
        $validator1 = Validator::make($request->all(), $this->book->rules(), $this->book->feedback());

        if($validator1->fails()) {
            return response()->json(['errors' => $validator1->errors()], 422);
        }

        // Validating author information related to the book
        $books_authors = $request->all('authors_id');

        $validator2 = Validator::make($books_authors, [
            'authors_id' => 'required|array'
        ]);

        if($validator2->fails()) {
            return response()->json(['errors' => $validator2->errors()], 422);
        }

        $book->update($request->all());

        // Remove authors related to the book
        $this->bookAuthor->where("book_id", $book['id'])->delete();

        // Registering authors related to the book
        foreach($books_authors['authors_id'] as $author) {

            $this->bookAuthor->create([
                'book_id'   => $book['id'],
                'author_id' => $author 
            ]);
        }

        $book['authors'] = $this->bookAuthor->returnAuthorsBook($book['id']);

        return response()->json($book, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = $this->book->find($id);

        if($book === null) {
            return response()->json(['erro' => 'Não foi possível realizar a alteração, pois o livro solicitado não existe'], 404);
        }
        
        // Remove authors related to the book
        $this->bookAuthor->where("book_id", $book['id'])->delete();

        // Remove book
        $book->delete();

        return response()->json(['msg' => 'Livro removido com sucesso'], 200);
    }
}
