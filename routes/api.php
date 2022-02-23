<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// include auth controller
use App\Http\Controllers\AuthController;
// include product controller
use App\Http\Controllers\API\ProductController;

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

// Authentication API Router
// Register
Route::post('/register', [AuthController::class, 'register']);
// Login
Route::post('/login', [AuthController::class, 'login']);
// Logout
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

// Product API Routers
// Public
// Get all product
Route::get('/product/products', [ProductController::class, 'index']);
// Get product by params id
Route::get('/product/show-product/{id}', [ProductController::class, 'show']);
// Search product by name
Route::get('/product/search-product/{name}', [ProductController::class, 'search']);

// Private
Route::middleware('auth:sanctum')->group(function () {
    // Create product
    Route::post('/product/create-product', [ProductController::class, 'store']);
    // Update product by params id
    Route::patch('/product/update-product/{id}', [ProductController::class, 'update']);
    // Delete product by params id
    Route::delete('/product/delete-product/{id}', [ProductController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
