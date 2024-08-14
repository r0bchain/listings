<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class RealtorListingAcceptController extends Controller
{
    /*
    * @dev __invoke() method is called when an object is treated as a function.
    */
    public function __invoke(\App\Models\Offer $offer)
    {

        $response = Gate::inspect('update-accepted', $offer->listing, Listing::class);

        if (!$response->allowed()) {
            // The action is authorized...
            echo $response->message();
            return redirect()->back()->with('error', $response->message());

        } 
        // Accept selected offer
        $offer->update(['accepted_at' => now()]);

        $offer->listing->sold_at = now();
        $offer->listing->save();
        
        $offer->listing->offers()
            ->whereKeyNot($offer->id)
            ->update(['rejected_at' => now()]);
        //return inertia('Realtor/Accept');

        return redirect()->back()->with('success', "Offer # {$offer->id} was accepted!");
    }
}
