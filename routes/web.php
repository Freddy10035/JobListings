<?php

use App\Models\Listing;
use PhpParser\Node\Stmt\Else_;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

// Route::get('/', function () {
//     return view('listings',[
//         'listings' => Listing::all()
//      ]);
// });



// Route::get('/listings/{listing}', function(Listing $listing){

//     return view ('listing', [
//         'listing' => $listing
//     ]);  
// });

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing 

//U and u

//All listing
Route::get('/', [ListingController::class, 'index']);



//Show create Form
Route::get('/listings/create', [ListingController::class, 'create']);

//Store Listing Data
Route::post('/listings', [ListingController::class, 'store']);

//Show Edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit']);

//Edit submit to update
Route::put('/listings/{listing}', [ListingController::class, 'update']);

//Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy']);

//Single listing
Route::get('/listings/{listing}',[ListingController::class, 'show']);

//show register create form
Route::get('/register', [UserController::class, 'create']);

//Create new user
Route::post('/users', [UserController::class, 'store']);

//log users out
Route::post('/logout', [UserController::class, 'logout']);

//show login form
Route::get('/login',[UserController::class, 'login']);

//Log in user
Route::post('/users/authenticate',[UserController::class, 'authenticate']);