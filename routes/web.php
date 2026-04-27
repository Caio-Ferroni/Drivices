<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\UserController;
use App\Models\Oferta;
use App\Models\Usuario;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
Route::view('/home', 'home');
Route::view('/area-segura', 'area-segura')->middleware('auth', 'password.confirm')->name('area-segura');
Route::view('/verificacao-email', 'verificacao-email')->middleware('auth', 'verified')->name('verificacao-email');
Route::view('/codigo', 'auth.two-factor-challenge');

Route::resource('users', UserController::class);
Route::resource('pedidos', PedidoController::class);
Route::resource('professionals', ProfessionalController::class);
Route::resource('pedidos.ofertas', OfertaController::class)->shallow();
// Route::resource('ofertas', OfertaController::class);


