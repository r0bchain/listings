<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing) 
    {
        
        return inertia('Realtor/ListingImages/Create', [
            'listing' => $listing
        ]);
    }

    public function store(Listing $listing, Request $request) 
    {
     //  dd($request->hasFile('images'));
        if($request->hasFile('images')) {
          foreach($request->file('images') as $image) {
          
            $listing->images()->create([
              'filename' => $image->store('images', 'public')
            ]);
          }
        }

        return redirect()->back()->with('success', 'Images uploaded successfully');
    }
}
