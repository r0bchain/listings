<?php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\QueryException;
use App\Models\ListingImage;
use App\Events\JobPinnedFinished;

class UploadToIPFS implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

	protected $filePath;
	protected $fileName;
	protected $jwtToken;
    protected $listing;

	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct($filePath, $fileName, $jwtToken, $listing)
	{
		$this->filePath = $filePath;
		$this->fileName = $fileName;
		$this->jwtToken = $jwtToken;
        $this->listing = $listing;
	}

	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
		//$url = env('PINATA_GATEWAY','https://api.pinata.cloud/pinning/pinFileToIPFS');
        $url = env('PINATA_GATEWAY_UPLOADS', 'https://api.pinata.cloud/pinning/pinFileToIPFS');

		// Check if the file exists
		if (!file_exists($this->filePath)) {
			Log::error('File not found: ' . $this->filePath);
			return;
		}

		// Log the file details
		Log::info('Uploading file to IPFS 1', ['filePath' => $this->filePath, 'fileName' => $this->fileName]);

        Log::info('category', ['name' => $this->listing->category->name, 'id' => $this->listing->id]);

        // Define metadata
        $metadata = [
            'name' => $this->fileName,
            'keyvalues' => [
                // 'listing_id' => $this->listing->id,
				'website' => env('APP_URL'),
				'listing' => route('listing.show', ['listing' => $this->listing->slug]),
				'title' => $this->listing->title,
				'description' => $this->listing->description,
                'category' =>  $this->listing->category->name
                // Add more key-value pairs as needed
            ]
        ];

		// Make the request to Pinata
		$response = Http::withHeaders([
					'Authorization' => 'Bearer ' . $this->jwtToken,
				])->attach(
					'file', file_get_contents($this->filePath), $this->fileName
				)->attach(
                    'pinataMetadata', json_encode($metadata)
                )->post($url);

        // Log the request details
        Log::info('Pinata request', [
            'url' => $url,
            'headers' => ['Authorization' => 'Bearer ' . $this->jwtToken],
            'file' => [
                'path' => $this->filePath,
                'name' => $this->fileName
               // 'content' => file_get_contents($this->filePath)
            ]
        ]);

        // Log the response
        Log::info('Pinata response 1', [
            'response' => $response->body(),
            'status' => $response->status(),
        ]);

		// If the image was pinned successfully
		if ($response->successful()) {
			Log::info('File uploaded to IPFS successfully', ['response' => $response->json()]);
            
            // Add CId to database
            $data = $response->json();
            $listingImage = new ListingImage();
            $listingImage->filename = $this->fileName;
            $listingImage->cid = $data['IpfsHash'];
            $listingImage->listing_id = $this->listing->id;
			try {
				$listingImage->save();
				event(new JobPinnedFinished($this->listing->id));
				Log::info('JobPinnedFinished job completed successfully', ['listing_id' => $this->listing->id]);


			} catch (QueryException $e) {
				
				if ($e->getCode() == 23000) {
					// Handle the duplicate entry error
					// For example, log the error or notify the user
					Log::error('Duplicate entry for CID: ' . $data['IpfsHash']);
				} else {
					throw $e; // Rethrow the exception if it's not a duplicate entry error

				}
			}


		} else {
			// Log the error response
			Log::error('Failed to upload....', ['response' => $response->body()]);
		}
	}
}