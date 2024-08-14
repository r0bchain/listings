<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use \App\Models\Listing;

class RealtorListingController extends Controller
{
    public function index(Request $request) 
    {


        $filters = [
            'deleted' => $request->boolean('deleted'),
            ...$request->only(['by', 'order'])
        ];
    
        return inertia(
            'Realtor/Index',
            
            [
            'filters' => $filters,
            'listings' => Auth::user()
                ->listings() 
                ->filter($filters)
                ->withCount('images')
                ->withCount('offers')
                ->paginate(10)
                ->withQueryString()
            ],
        );
    
    }
    public function show(Listing $listing) 
    {
      
        return inertia(
            'Realtor/Show', 
            // Load listing with its offers and the bidder of each offer
            ['listing' => $listing->load('offers', 'offers.bidder')]
        );
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

        return inertia('Realtor/Edit',
        [
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

        return inertia('Realtor/Create');
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

        return redirect()->route('realtor.listing.index', $listing->id)
        ->with('success', 'Listing updated successfully.');

    }

      /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        $request->user()->listings()->create($validatedData);

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing created successfully.');
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

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing deleted successfully.');
    }

    public function hard_delete(Request $request)
    {
        $response = Gate::inspect('hard-listing', $listing, Listing::class);
        $listing->forceDelete();

    }

    public function restore(Listing $listing)
    {
        $listing->restore();
        return redirect()->route('realtor.listing.index', $listing->id)
        ->with('success', 'Listing restored successfully.');
    }   

}
