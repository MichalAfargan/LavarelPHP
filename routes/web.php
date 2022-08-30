<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\ProductsController;
use Illuminate\Auth\Events\Login;

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


// all lists
Route::get('/', [ListingController::class, 'index']);


//show Creat form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store Listing Data
Route::post('/listings',
[ListingController::class,'store'])->middleware('auth');


// Show Edit Form
Route::get('/listings/{listing}/edit',
[ListingController::class, 'edit']
)->middleware('auth');

// Edit Sumbit to Update
Route::put('/listings/{listing}',
[ListingController::class, 'update'])->middleware('auth');

//Delete Listing
Route::delete('/listings/{listing}',
[ListingController::class, 'destroy'])->middleware('auth');

//Manage Listing
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');


// one list
Route::get('/listings/{listing}',
[ListingController::class,'show']);


//show register form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');


//create new User
Route::post('/users',[UserController::class, 'store']);


//log user out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

//login user
Route::post('/users/authenticate', [UserController::class,'authenticate']);







// Route::get('/posts/{id}', function($id){
//     dd($id);
//     return response('Post' . $id);
// })->where('id', '[0-9]+');

// Route::get('/search', function(Request $request){
//     return $request->name . ' ' . $request->dec;
// }); 

