<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'dt_birth'
    ];

    public function rules()
    {   
        return [
            'name'      => 'required',
            'dt_birth'  => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório'
        ];
    }
}
