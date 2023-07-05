<?php

use App\Mail\MensagemTestMail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')
//     ->middleware('verified');
Route::get('tarefa/export/{extensao}', [App\Http\Controllers\TarefaController::class, 'exportar'])->name('tarefa.export')
    ->middleware('verified');

Route::resource('tarefa', 'App\Http\Controllers\TarefaController')
    ->middleware('verified');

Route::get('mensagem-test', function() {
    return new MensagemTestMail();
    // Mail::to('skylyfe1234@gmail.com')->send(new MensagemTestMail());
    // return 'E-mail enviado com sucesso!!!';
});
