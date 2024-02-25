<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::group(['middleware'=>'disable_back_btn'], function(){
    Route::middleware('auth')->group(function () {
        Route::resource('users', UserController::class);
        Route::get('/search', [UserController::class, 'search'])->name('user.search');
        Route::get('/filter', [UserController::class, 'filter'])->name('user.filter');
        Route::get('/pagination/paginate-data', [UserController::class, 'pagination'])->name('pagination');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/password', [PasswordController::class, 'edit'])->name('profile.change-pass');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('@deleteProfile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('khoas', KhoaController::class);
        Route::get('/search', [KhoaController::class, 'search'])->name('khoa.search');

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');
    });
});

require __DIR__.'/auth.php';
