<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookAuthor extends Model
{
    use HasFactory;

    protected $table = 'books_authors';

    protected $fillable = [
        'book_id',
        'author_id'
    ];

    public function returnAuthorsBook(?int $book_id)
    {
        $authors = $this
                        ->select(
                            'books_authors.author_id', 
                            'authors.name',
                            'authors.dt_birth',
                            'books_authors.created_at',
                            'books_authors.updated_at'
                        )
                        ->join("authors", "authors.id", "=", "books_authors.author_id")
                        ->where("book_id", $book_id)
                        ->get();

        return $authors;
    }
}
