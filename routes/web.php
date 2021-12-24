<?php

use App\Http\Controllers\WordsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return response()->view('translate');});
Route::get('/enter', function (){return response()->view('enter');});
Route::get("/list", function () {return response()->view('get-list');});
Route::get("/all-words", [WordsController::class, "allWords"])->name('all-words');

Route::post('/check', [WordsController::class, 'check'])->name("checking");
Route::post('/enter', [WordsController::class, 'add'])->name("enter");
Route::post('/list', [WordsController::class, 'wordList'])->name("word-list");
Route::delete('/del_word', [WordsController::class, 'delWord'])->name("del_word");

