<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\UsersController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/add',[BooksController::class, 'show']);

Route::post('/add',[BooksController::class, 'create']);

Route::get('/addebook',[EbookController::class, 'showebook']);

Route::post('/addebook',[EbookController::class, 'createebook']);

Route::get('/addUser',[UsersController::class, 'showUser']);

Route::post('/addUser',[UsersController::class, 'createUser']);

Route::post('/login',[UsersController::class, 'login']);

