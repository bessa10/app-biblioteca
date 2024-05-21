<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'description',
        'year_publication'
    ];

    public function rules()
    {   
        return [
            'title'      => 'required',
            'year_publication'  => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório'
        ];
    }
}
