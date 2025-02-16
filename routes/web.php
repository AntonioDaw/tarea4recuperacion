<?php

use Lib\Route;
use App\Controllers\HomeController;
use App\Controllers\UsuarioController;

// Indicaremos la clase del controlador y el método a ejecutar. Solo algunas rutas están implementadas
// Tendremos rutas para get y pst, así como parámetros opcionales indicados con : que podrán
// ser recuperados por un mismo controlador. Por ejemplo, /curso/:variable y /curso/ruta1 usan el mismo controlador
// y :variable se trata como un parámetro ajeno a la ruta
Route::get('/', [UsuarioController::class, 'table']);
Route::get('/usuario/table', [UsuarioController::class, 'table']);
Route::get('/usuario/login', [UsuarioController::class, 'login']);
Route::get('/usuario/atacar/:inicio', [UsuarioController::class, 'atacar']);
Route::Post('/usuario/ataque', [UsuarioController::class, 'ataque']);
Route::get('/usuario/salir', [UsuarioController::class, 'salir']);
Route::get('/usuario/nuevo', [UsuarioController::class, 'create']);
Route::get('/usuario/modificar/:id', [UsuarioController::class, 'modificar']);
Route::get('/usuario/index', [UsuarioController::class, 'index']);
Route::post('/usuario/index', [UsuarioController::class, 'index']);
Route::get('/usuario/:id', [UsuarioController::class, 'show']);
Route::post('/usuario/table', [UsuarioController::class, 'createTable']);
Route::post('/usuario/login', [UsuarioController::class, 'loginUser']);
Route::post('/usuario/traspaso', [UsuarioController::class, 'traspaso']);
Route::post('/usuario/actualizar', [UsuarioController::class, 'actualizar']);
Route::post('/usuario/update', [UsuarioController::class, 'update']);
Route::post('/usuario/store', [UsuarioController::class, 'store']);
Route::post('/usuario/borrar', [UsuarioController::class, 'delete']);

Route::dispatch();
