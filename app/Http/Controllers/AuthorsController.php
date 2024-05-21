<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    protected $author;

    public function __construct(Author $author)
    {
        $this->author = $author;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = $this->author->all();
        
        return response()->json($authors, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->author->rules(), $this->author->feedback());

        $author = $this->author->create($request->all());

        return response()->json($author, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = $this->author->find($id);

        if($author === null) {
            return response()->json(['erro' => 'Autor não encontrado com o código informado'], 404);
        }

        return response()->json($author, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $author = $this->author->find($id);

        if($author === null) {
            return response()->json(['erro' => 'Não foi possível realizar a alteração, pois o autor solicitado não existe'], 404);
        }

        $request->validate($this->author->rules(), $this->author->feedback());

        $author->update($request->all());

        return response()->json($author, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = $this->author->find($id);

        if($author === null) {
            return response()->json(['erro' => 'Não foi possível realizar a alteração, pois o autor solicitado não existe'], 404);
        }
        
        $author->delete();

        return response()->json(['msg' => 'Autor removido com sucesso'], 200);
    }
}
