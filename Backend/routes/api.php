<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function(){
    return response()->json(["message" => "Estas en la ruta '/' de api.php"]);
})->name('login');

// MOSTRAR MENSAJES DE LAS REQUEST FALLIDAS 

require __DIR__ . '/auth.php';
