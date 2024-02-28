<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ChucvuController;
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
        Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/search', [UserController::class, 'search'])->name('user.search');
        Route::get('/filter', [UserController::class, 'filter'])->name('user.filter');
        Route::get('/pagination/paginate-user', [UserController::class, 'pagination'])->name('pagination');
        Route::post('/check_email_unique', [UserController::class, 'check_email_unique'])->name('check_email_unique');
        Route::post('/check_account_unique', [UserController::class, 'check_account_unique'])->name('check_account_unique');
        Route::post('/check_current_password', [UserController::class, 'check_current_password'])->name('check_current_password');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/password', [PasswordController::class, 'edit'])->name('profile.change-pass');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('@deleteProfile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::resource('khoas', KhoaController::class);
        Route::get('/searchk', [KhoaController::class, 'searchk'])->name('khoa.search');

        Route::resource('chucvus', ChucvuController::class);
        Route::get('/searchc', [ChucvuController::class, 'searchc'])->name('chucvu.search');
        Route::get('/pagination/paginate-chucvu', [ChucvuController::class, 'pagination'])->name('pagination');

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth', 'verified'])->name('dashboard');
    });
});

require __DIR__.'/auth.php';
