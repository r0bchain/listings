<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing) 
    {

        $listing->load('images');

        return inertia('Realtor/ListingImages/Create', [
            'listing' => $listing
        ]);
    }

    public function store(Listing $listing, Request $request) 
    {
     //  dd($request->hasFile('images'));
        if($request->hasFile('images')) {
          $request->validate( [
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
          ], 
          [
            'images.*.image' => 'The file must be an image',
            'images.*.mimes' => 'The image must be a files of type: jpeg, png, jpg, gif, svg',
            'images.*.max' => 'The image must be a files of type: jpeg, png, jpg, gif, svg and not exceed 2MB'
          ]);

          foreach($request->file('images') as $image) {
            $listing->images()->create([
              'filename' => $image->store('images', 'public')
            ]);
          }
        }

        return redirect()->back()->with('success', 'Images uploaded successfully');
    }

 
    public function destroy ($listing, ListingImage $image) 
    {

        Storage::disk('public')->delete($image->filename);
        $image->delete();
        return redirect()->back()->with('success', 'Image deleted successfully');
    }
}
