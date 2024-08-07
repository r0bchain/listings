<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\UserAccountController;

Route::get('/', function () {
    // return view('welcome');
    return inertia('index/index');
});

Route::get('/', [IndexController::class, 'index']);
Route::get('/hello', [IndexController::class, 'show'])
  ->middleware('auth'); 

// Route::resource('listing', ListingController::class)
//   ->only(['create', 'store'])
//     ->middleware('auth');
    
Route::resource('listing', ListingController::class)
->only(['index', 'show']);
// ->can('index', 'view');


Route::get('login', [AuthController::class, 'create'])
->name('login');

Route::post('login', [AuthController::class, 'store'])
->name('login.store');

Route::post('logout', [AuthController::class, 'destroy'])
->name('logout');

Route::resource('user-account', UserAccountController::class)
  ->only(['create', 'store']);

Route::prefix('realtor')
  ->name('realtor.')
  ->middleware('auth')
  ->group(function () {
    Route::name('listing.restore')
      ->put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])
      ->withTrashed();
    Route::resource('listing', RealtorListingController::class)
      ->only(['index', 'destroy', 'edit', 'update', 'create', 'destroy', 'restore'])
      ->withTrashed();
    // Route::get('listing/trash', [RealtorListingController::class, 'trash'])->name('listing.trash');
});
