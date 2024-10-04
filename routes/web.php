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
use App\Http\Controllers\CategoryController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
      ->parameters(['listing' => 'listing:slug']) // Use slug instead of ID
      ->withTrashed();

    Route::name('offer.accept')
      ->put('offer/{offer}/accept', [RealtorListingAcceptController::class, '__invoke']);

    Route::resource('listing.image', RealtorListingImageController::class)
      ->only(['create', 'store', 'destroy']);
});

//his view will be displayed to users when they 
//try to access other parts of the application without verifying their email address first.
Route::get('/email/verify', function () {
  return inertia('Auth/VerifyEmail');
})
  ->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
  $request->fulfill();

  return redirect()->route('listing.index')
    ->with('success', 'Email was verified!');
  // return  inertia('Index/Index', ['message' => 'Welcome on board!']);

})->middleware(['auth', 'signed'])->name('verification.verify');

// throttle limit the number of requests to the route in a given time, 
// it use the cache to perform the check (in this example, 6 requests per minute)
Route::post('/email/verification-notification', function (Request $request) {
  $request->user()->sendEmailVerificationNotification();
  return redirect()->route('listing.index')
  ->with('success', 'Verification link sent!');

  // return back()->with('success', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::resource('category', CategoryController::class)
  ->only(['update']);