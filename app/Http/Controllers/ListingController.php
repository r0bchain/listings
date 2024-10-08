<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Category;
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
     
        $filters = $request->only(['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo', 'categoryId', 'city']);
        $category   =  
        ($filters && $filters['categoryId']) ? 
        Category::select('name', 'cover_image', 'id', 'parent_id')->where('id', $filters['categoryId'])->first() 
        : Category::select('name', 'cover_image', 'id', 'parent_id')->first();
        
        $categoriesChildren = ($filters && isset($filters['categoryId'])) ? 
        Category::where('parent_id', $filters['categoryId'])->get() : null;

        // dd($category );
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
            

            'filters' => $filters,
            'cities' => Listing::select('city')->distinct()->get(),
            'category' => $category,
            'categoriesChildren' => $categoriesChildren,
            'defaultCity' => env('DEFAULT_CITY'),
            'pexelKey'=> env('RANDOM_IMAGE_KEY')


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

      $response = Gate::inspect('view-listing', $listing, Listing::class);
      
      if (!$response->allowed()) {
        
        // The action is authorized...
        return redirect()->route('listing.index')
        ->with('error', 'Listing not available.');


      }
      

      $listing->load('images');
      // $offer = !Auth::user() ? null : $listing->offers()->where('bidder_id', Auth::user()->id)->first();
      $offer = !Auth::user() ? 
        null : 
        $listing->offers()->byMe()->first();
     // dd($listing);
      return inertia('Listing/Show',
      [
          // 'listing' => Listing::find($id)
          'listing' => $listing,
          'offerMade' => $offer

      ]
    );
    }

 

   
}
