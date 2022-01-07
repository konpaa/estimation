<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('auth/register', [AuthController::class, 'register'])->name('register');
Route::post('auth/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {

    Route::post('auth/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('roles:user')->group(function () {
        Route::apiResource('users/products', ProductController::class)->names('users.products');
    });

    Route::middleware('roles:admin')->group(function () {
        Route::apiResource('admin/users', AdminUserController::class)->names('admin.users');
        Route::apiResource('admin/users/{user}/products', AdminProductController::class)->names('admin.products');
    });
});
