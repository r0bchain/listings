<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Offer;
use App\Notifications\OfferMade;


class ListingOfferController extends Controller
{
    public function store(Listing $listing, Request $request)
    {
    
        $listing->offers()->save( Offer::make(
            $request->validate([
                'amount' => 'required|numeric',
                // 'expires_at' => 'required|date',
                ])
            )->bidder()->associate($request->user())
        );

        $listing->owner->notify(new OfferMade($listing->offers->last()));

        return redirect()->back()->with('success', 'Offer was made!');
    }
}
