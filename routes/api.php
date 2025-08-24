<?php
use App\Http\Controllers\Api\UsuarioApiController;

Route::post('/usuario/cadastrar', [UsuarioController::class, 'cadastrar']);
Route::post('/usuario/login', [UsuarioController::class, 'login']);

?>