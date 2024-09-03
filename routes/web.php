<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/aselole', function () {
    echo "pala pele";
});

Route::post('/dadakdidik', function () {
    echo "didik duduk";
});

Route::get('/user/{id}', function ($id='') {
    return "Hola diablos " . $id;
});