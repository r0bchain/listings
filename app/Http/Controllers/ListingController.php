<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
class ListingController extends Controller
{

    /*
    * ALTERNATIVE WAY TO PROTECT THE ROUTES
    * Middleware to protect the routes from unauthorized access.
    */
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show']);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']);
        //$query = Listing::orderByDesc('created_at');
        // dd(  $filters);
        return  inertia('Listing/Index',
        [
            // Returns an array with the listings
            // 'listings' => Listing::all()
            // Returns an object with the listings and the pagination links
            'listings' => 
            Listing::mostRecent()
            ->withCount('images')
            ->withOutSold()
            ->filter($filters)
            ->paginate(10)
            ->withQueryString(),

            'filters' => $request->only(['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']),

        ]
      );
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)

    // Route model binding. Laravel will automatically fetch the model for the given id parameter passed
    public function show(Listing $listing)
    {    
      $listing->load('images');
      // $offer = !Auth::user() ? null : $listing->offers()->where('bidder_id', Auth::user()->id)->first();
      $offer = !Auth::user() ? 
        null : 
        $listing->offers()->byMe()->first();

      return inertia('Listing/Show',
      [
          // 'listing' => Listing::find($id)
          'listing' => $listing,
          'offerMade' => $offer

      ]
    );
    }

 

   
}
