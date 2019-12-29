<?php

use Illuminate\Support\Facades\Route;

Route::get('/users', 'Users@fetch')->middleware('auth:api', 'role:ROLE_ADMIN');
