<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanModel extends Model
{
    use HasFactory;

    protected $table = 'loans';

    protected $fillable = [
        'user_id',
        'book_id',
        'dt_loan',
        'dt_return'
    ];

    public function rules()
    {   
        return [
            'user_id'   => 'required',
            'book_id'   => 'required',
            'dt_loan'   => 'required',
            'dt_return' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório'
        ];
    }
}
