<?php

use Illuminate\Support\Facades\Route;

Route::post('/product', 'Product@create')->middleware('auth:api', 'role:ROLE_ADMIN');
Route::put('/product/{id}', 'Product@edit')->middleware('auth:api', 'role:ROLE_ADMIN');
Route::delete('/product/{id}', 'Product@delete')->middleware('auth:api', 'role:ROLE_ADMIN');

Route::get('/products', 'Product@fetch');
Route::get('/product', 'Product@fetchSingle');
