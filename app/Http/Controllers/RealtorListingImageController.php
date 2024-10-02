<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Jobs\UploadToIPFS;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing) 
    {

        $listing->load('images');
        
        $url = env('PINATA_GATEWAY','https://api.pinata.cloud/pinning/pinFileToIPFS');

        return inertia('Realtor/ListingImages/Create', [
            'listing' => $listing,
            'pinataGateway' => $url
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
            'images.*.max' => 'The image must be a files of type: jpeg, png, jpg, gif, svg and not exceed 1MB'
          ]);

          foreach($request->file('images') as $image) {
            $url =  env('PINATA_GATEWAY'); // IPFS local node API endpoint
            $jwtToken =  env('PINATA_SECRET_JWT');
            // $filePath = $image->getPathName();
            // $fileName = $image->getClientOriginalName();
            $filePath = $image->store('uploads', 'public');
            $absoluteFilePath = storage_path('app/public/' . $filePath);
            $fileName = $image->getClientOriginalName();
            // Dispatch the job
            UploadToIPFS::dispatch($absoluteFilePath, $fileName, $jwtToken, $listing);

            //return response()->json(['message' => 'File upload initiated.']);
             

            // return response()->json(['success' => false, 'error' => 'Failed to upload to IPFS, gateway ' . $url  ]);
            // $listing->images()->create([
            //   'filename' => $image->store('images', 'public')
            // ]);
          }
        }

        return redirect()->back()->with('success', 'Image upload initiated, please refresh the page after a few seconds.');
    }

 
    public function destroy ($listing, ListingImage $image) 
    {

        Storage::disk('public')->delete($image->filename);
        $image->delete();
        return redirect()->back()->with('success', 'Image deleted successfully');
    }
}
