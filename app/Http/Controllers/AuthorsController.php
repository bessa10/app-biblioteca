<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Exception;

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
        
        return $authors;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $author = $this->author->create($request->all());

        return $author;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $author = $this->author->find($id);

        return $author;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $author = $this->author->find($id);

        $author->update($request->all());

        return $author;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $author = $this->author->find($id);
        
        $author->delete();

        return ['msg' => 'The author was successfully removed'];
    }
}
