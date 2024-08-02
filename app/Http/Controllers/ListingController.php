<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Facades\Gate;

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
        $query = Listing::orderByDesc('created_at');

       
        if ($filters['priceFrom'] ?? false) {
            $query->where('price', '>=', $filters['priceFrom']);
        }

        if ($filters['priceTo'] ?? false) {
            $query->where('price', '<=', $filters['priceTo']);
        }

        if ($filters['beds'] ?? false) {
            $query->where('beds', $filters['beds']);
        }

        if ($filters['baths'] ?? false) {
            $query->where('baths', $filters['baths']);
        }

        if ($filters['areaFrom'] ?? false) {
            $query->where('area', '>=', $filters['areaFrom']);
        }

        if ($filters['areaTo'] ?? false) {
            $query->where('area', '<=', $filters['areaTo']);
        }


        return  inertia('Listing/Index',
        [
            // Returns an array with the listings
            // 'listings' => Listing::all()
            // Returns an object with the listings and the pagination links
            'listings' => $query->paginate(10)->withQueryString(),
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
        return inertia('Listing/Show',
        [
            // 'listing' => Listing::find($id)
            'listing' => $listing

        ]
      );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $response = Gate::inspect('create', Listing::class);
        if (!$response->allowed()) {
            // The action is authorized...
            echo $response->message();
            return redirect()->route('listing.index')
            ->with('error', $response->message());
            // ->with('error', 'Listing not accesible.');

        }

        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        // Listing::create($request->all());
        $validatedData = $request->validate([
            'beds' => 'required|integer|min:1|max:20',
            'baths' => 'required|integer|min:1|max:20',
            'area' => 'required|integer|min:15|max:1500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|integer|min:0|max:1000',
            'price' => 'required|integer|min:1|max:20000000',

        ]);

        //Listing::create($validatedData);

        $request->user()->listings()->create($validatedData);

        return redirect()->route('listing.index')
            ->with('success', 'Listing created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        $response = Gate::inspect('update', $listing, Listing::class);
        if (!$response->allowed()) {
            // The action is authorized...
            echo $response->message();
            return redirect()->route('listing.show', $listing->id)
            ->with('error', $response->message());
            // ->with('error', 'Listing not accesible.');

        } 

        return inertia('Listing/Edit',
        [
            'listing' => $listing
        ]
      );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {

        // $response = Gate::inspect('update', $listing, Listing::class);
        $response = Gate::inspect('update-listing', $listing, Listing::class);

        if (!$response->allowed()) {
            // The action is authorized...
            echo $response->message();
            return redirect()->route('listing.show', $listing->id)
            ->with('error', $response->message());
            // ->with('error', 'Listing not accesible.');

        } 
        
        $validatedData = $request->validate([
            'beds' => 'required|integer|min:1|max:20',
            'baths' => 'required|integer|min:1|max:20',
            'area' => 'required|integer|min:15|max:1500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|integer|min:0|max:1000',
            'price' => 'required|integer|min:1|max:20000000',

        ]);

        $listing->update($validatedData);

        return redirect()->route('listing.show', $listing->id)
        ->with('success', 'Listing updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {

          // $response = Gate::inspect('update', $listing, Listing::class);
        $response = Gate::inspect('delete-listing', $listing, Listing::class);

        if (!$response->allowed()) {
            // The action is authorized...
            echo $response->message();
            return redirect()->route('listing.show', $listing->id)
            ->with('error', $response->message());
            // ->with('error', 'Listing not accesible.');

        } 

        $listing->delete();

        // Return to the current page, bad idea to use this for the show page.
        // return redirect()->back()
        //     ->with('success', 'Listing deleted successfully.');

        return redirect()->route('listing.index')
            ->with('success', 'Listing deleted successfully.');
    }
   
}
