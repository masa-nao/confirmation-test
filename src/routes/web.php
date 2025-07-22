<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'showAdmin'])->name('admin.show');
    Route::post('/admin', [AdminController::class, 'search'])->name('admin.search');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');

    Route::get('/', [ContactController::class, 'index'])->name('index');
    Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');
    Route::get('/confirm', function () {
        return redirect()->route('index');
    });
    Route::post('/thanks', [ContactController::class, 'store'])->name('store');
    Route::get('/thanks', function () {
        return view('thanks');
    })->name('thanks');
});
