<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoanModel;

class LoansController extends Controller
{
    protected $loan;

    public function __construct()
    {
        $this->loan = new LoanModel();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loans = $this->loan->all();
        
        return response()->json($loans, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->loan->rules(), $this->loan->feedback());

        print_r($request->all('dt_loan'));die;

        $loan = $this->loan->create($request->all());

        return response()->json($loan, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $loan = $this->loan->find($id);

        if($loan === null) {
            return response()->json(['erro' => 'Empréstimo não encontrado com o código informado'], 404);
        }

        return response()->json($loan, 200);
    }
}
