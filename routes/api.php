<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/products", [ProductApiController::class, "index"]);
Route::post("/products", [ProductApiController::class, "store"]);
Route::get("/products/{product}", [ProductApiController::class, "show"]);
Route::put("/products/{product}", [ProductApiController::class, "update"]);
Route::delete("/products/{product}", [ProductApiController::class, "destroy"]);
