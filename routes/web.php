<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\PersonneController;

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
    return view('welcome');
});


Route::post('register', [AuthController::class, 'register'])->name('register.api');
Route::post('login', [AuthController::class, 'login'])->name('login.api');

Route::get('listeUtilisateurs', [AuthController::class, 'index'])->name('index.api');

Route::get('listeUtilisateurs/{id}', [AuthController::class, 'findOneUser'])->name('findOneUser.api');

Route::put('listeUtilisateurs/{id}', [AuthController::class, 'update'])->name('update.api');

Route::post('personnes', [PersonneController::class, 'store'])->name('store.api');

Route::get('personnes', [PersonneController::class, 'allPersonne'])->name('allPersonne.api');

Route::get('personnes/{id}', [PersonneController::class, 'show'])->name('show.api');
