<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RealtorListingController;
use App\Http\Controllers\UserAccountController;
use App\Http\Controllers\RealtorListingImageController;
use App\Http\Controllers\ListingOfferController;
use App\Http\Controllers\RealtorListingAcceptController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

// Route::get('/', function () {
//     return inertia('index/index');
// });

Route::get('/', [ListingController::class, 'index']);


Route::resource('listing', ListingController::class)
  ->only(['index', 'show']);
// ->can('index', 'view');

Route::resource('listing.offer', ListingOfferController::class)
  ->only(['store'])
  ->middleware('auth', 'verified');

Route::resource('notification', NotificationController::class)
  ->only(['index'])
  ->middleware('auth', 'verified');

Route::put(
  'notification/{notification}/seen',
  NotificationSeenController::class
)->middleware('auth')->name('notification.seen');

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
  ->middleware('auth', 'verified')
  ->group(function () {
    Route::name('listing.restore')
      ->put('listing/{listing}/restore', [RealtorListingController::class, 'restore'])
      ->withTrashed();
    Route::resource('listing', RealtorListingController::class)
      // ->only(['index', 'destroy', 'edit', 'update', 'create', 'store', 'destroy', 'restore'])
      ->withTrashed();

    Route::name('offer.accept')
      ->put('offer/{offer}/accept', [RealtorListingAcceptController::class, '__invoke']);

    Route::resource('listing.image', RealtorListingImageController::class)
      ->only(['create', 'store', 'destroy']);
});

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();

  return  inertia('Index/Index', ['message' => 'Welcome on board!']);

})->middleware(['auth', 'signed'])->name('verification.verify');