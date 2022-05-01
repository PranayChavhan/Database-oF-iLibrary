<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\IssuedBookController;
use App\Http\Controllers\AcceptBookController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\TeachersController;

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

Route::get('/add/{category}', [BooksController::class, 'searchByCaterory']);

Route::get('/search/{title}', [BooksController::class, 'searchByName']);

Route::post('/add',[BooksController::class, 'create']);

Route::get('/addebook',[EbookController::class, 'showebook']);

Route::post('/addebook',[EbookController::class, 'createebook']);

Route::get('/addUser',[UsersController::class, 'showUser']);

Route::post('/addUser',[UsersController::class, 'createUser']);

Route::post('/login',[UsersController::class, 'login']);

Route::post('/loginAdmin',[UsersController::class, 'loginAdmin']);

Route::post('/changepassword/{id}',[UsersController::class, 'changePassword']);

Route::post('/wishlist',[WishlistController::class, 'createWishlist']);

Route::get('/wishlist/{userEmail}',[WishlistController::class, 'searchByUserEmail']);


Route::post('/issuedbook',[IssuedBookController::class, 'createIssuedBook']);

Route::post('/issuedbook/{id}',[IssuedBookController::class, 'updateBook']);


Route::post('/acceptbook',[AcceptBookController::class, 'acceptbook']);

Route::get('/acceptbook/{userEnrollment}',[AcceptBookController::class, 'searchByEnrollment']);

Route::get('/issuedbook/{userEmail}',[IssuedBookController::class, 'searchByUserEmail']);

Route::get('/allissuedbook',[IssuedBookController::class, 'showIssuedBook']);

Route::get('/resources',[ResourcesController::class, 'show']);

Route::post('/resources',[ResourcesController::class, 'create']);

Route::get('/teachers',[TeachersController::class, 'showTeacher']);

Route::post('/teachers',[TeachersController::class, 'createTeacher']);

Route::post('/teacherslogin',[TeachersController::class, 'login']);

