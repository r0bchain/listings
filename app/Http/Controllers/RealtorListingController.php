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
            ->paginate(1)
            ->withQueryString()
        ]
    );
    
    
    return inertia(
        'Realtor/Index',
        ['listings' => Auth::user()->listings]
    );
    }

    public function show() {}

    public function destroy(Listing $listing, Request $request)
    {
        $response = Gate::inspect('delete-listing', $listing, Listing::class);

        if (!$response->allowed()) {
            // The action is authorized...
            echo $response->message();
            return redirect()->route('realtor.listing.index', $listing->id)
            ->with('error', $response->message());
            // ->with('error', 'Listing not accesible.');

        } 
        
       
        $listing->deleteOrFail();
        
        return redirect()->route('realtor.listing.index');
    }

    public function hard_delete(Request $request)
    {
        $response = Gate::inspect('hard-listing', $listing, Listing::class);
        $listing->forceDelete();

    }

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
        
    }
}
