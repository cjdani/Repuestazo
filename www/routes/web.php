<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::post('/home', function (Request $request) {
    $email = $request->input('email');
    $data['email'] = $email;
    return view('home', $data);
});
