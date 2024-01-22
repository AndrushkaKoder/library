<?php

use App\Controllers\BooksController;
use App\kernel\Router\Route;
use App\controllers\IndexController;


return [
	Route::get('/', [IndexController::class, 'index']),
	Route::get('/books', [BooksController::class, 'index']),
	Route::get('/book', [BooksController::class, 'show']),
	Route::get('/books/add', [BooksController::class, 'add']),
	Route::post('/books/create', [BooksController::class, 'create']),
	Route::post('/books/give_out', [BooksController::class, 'giveOut']),
	Route::post('/books/lose', [BooksController::class, 'lose']),
	Route::post('/search', BooksController::class, 'search'),
];
