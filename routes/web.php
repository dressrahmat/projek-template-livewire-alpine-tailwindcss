<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperAdmin\BlogController;
use App\Http\Controllers\SuperAdmin\RoleController;
use App\Http\Controllers\SuperAdmin\UserController;
use App\Http\Controllers\SuperAdmin\PermissionController;
use App\Http\Controllers\SuperAdmin\ProfileController as ProfileUser;

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
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('role', [RoleController::class, 'index'])->name('role.index');
    Route::get('permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/profile/{user}', [ProfileUser::class, 'edit'])->name('profile.edit');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');

    Route::get('/akun', [ProfileController::class, 'edit'])->name('akun.edit');
    Route::patch('/akun', [ProfileController::class, 'update'])->name('akun.update');
    Route::delete('/akun', [ProfileController::class, 'destroy'])->name('akun.destroy');
});

require __DIR__.'/auth.php';
