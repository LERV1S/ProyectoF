<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/bienvenida');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('producto', ProductoController::class);

Route::get('bienvenida', function(){
    return view('bienvenida');
})/*->middleware('auth')*/;

Route::get('perfil', function(){
    return view('perfil');
});

/* Route::middleware(['verified'])->group(function(){
    Route::get('bienvenida', function(){
        return view('bienvenida');
    });

    Route::get('contacto', function(){
        return view('contacto');
    });
}); */

Route::get('enviar-reporte', [ProductoController::class, 'enviarReporteMail']);
