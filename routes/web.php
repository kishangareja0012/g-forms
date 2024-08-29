<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])->name('login.index');
    Route::post('/login', [AuthController::class, 'login'])->name('login.request');
});

Route::middleware('auth')->group(function () {

    Route::get('/', [FormController::class, 'index'])->name('forms.index');
    Route::post('/forms', [FormController::class, 'create'])->name('forms.create');

    Route::get('/users', [FormController::class, 'index'])->name('users.index');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/form/{id}', [FormController::class, 'userFormView'])->name('forms.user');
Route::post('/form/{id}', [FormController::class, 'userFormRequest'])->name('form.user.submit');
