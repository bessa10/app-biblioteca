<?php

use Illuminate\Support\Facades\Route;

use App\Mail\MensagemEmprestimoMail;
use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email', function (){

    //return new MensagemEmprestimoMail();
    Mail::to('bruno.chaves@cscmedical.com.br')->send(new MensagemEmprestimoMail);
    return 'E-mail enviado com sucesso';
});