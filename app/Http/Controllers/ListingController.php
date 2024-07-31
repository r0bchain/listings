<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

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
    public function index()
    {
        return  inertia('Listing/Index',
        [
            'listings' => Listing::all()
        ]
      );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'beds' => 'required',
        //     'baths' => 'required',
        //     'price' => 'required',
        //     'city' => 'required',
        //     'street' => 'required',
        //     'street_nr' => 'required',
        // ]);

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

        Listing::create($validatedData);


        return redirect()->route('listing.index')
            ->with('success', 'Listing created successfully.');
    }

    /**
     * Display the specified resource.
     */
   // public function show(string $id)

    // Route model binding. Laravel will automatically fetch the model for the given id parameter passed
    public function show(Listing $listing)

    {
        return  inertia('Listing/Show',
        [
            // 'listing' => Listing::find($id)
            'listing' => $listing

        ]
      );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
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
        $listing->delete();

        // Return to the current page, bad idea to use this for the show page.
        // return redirect()->back()
        //     ->with('success', 'Listing deleted successfully.');

        return redirect()->route('listing.index')
            ->with('success', 'Listing deleted successfully.');
    }
   
}
