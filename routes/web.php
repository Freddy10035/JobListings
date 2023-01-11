<?php

use App\Http\Controllers\ListingController;
use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Stmt\Else_;

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

//All listing
Route::get('/', [ListingController::class, 'index']);



//Show create Form
Route::get('/listings/create', [ListingController::class, 'create']);

//Store Listing Data
Route::post('/listings', [ListingController::class, 'store']);

//Single listing
Route::get('/listings/{listing}',[ListingController::class, 'show']);

