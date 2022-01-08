<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;

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

    Route::middleware('roles:user')->as('users.')->prefix('users')->group(function () {
        Route::apiResource('categories/{category}/products', ProductController::class);
    });

    Route::middleware('roles:admin')->as('admin.')->prefix('admin')->group(function () {
        Route::apiResource('users', AdminUserController::class);
        Route::apiResource('users/{user}/categories/{category}/products', AdminProductController::class);
        Route::apiResource('categories', AdminCategoryController::class);
    });
});
