<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('home'));
Route::get('/login', fn () => view('login'));
Route::get('/register', fn () => view('register'));
Route::get('/add-task', fn () => view('add-task'));
Route::get('/edit-task/{id}', function ($id) {
    return view('edit-task', ['taskId' => $id]);
});

