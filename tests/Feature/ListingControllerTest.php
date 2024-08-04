<?php

namespace Tests\Feature;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class ListingControllerTest extends TestCase
{
    use RefreshDatabase;


    /**
     * Create a listing
     *
     * Returns 302 (not found), and redirects user to login form if not logged in
     */
    public function test_create_listing_returns_a_302_response_and_redirect_to_login_for_not_logged_user(): void
    {
        $response = $this->get('/listing/create');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /**
     * Create a listing
     *
     * Returns 302 (not found), and redirects user to login form if not logged in
     */
    public function test_edit_listing_returns_a_302_response_and_redirect_to_login_for_not_logged_user(): void
    {
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['owner_id' => $user->id]);
        $response = $this->get('/listing/' . $listing->id . '/edit');
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    /*
    * Positive test case, a user can delete a listing that they own
    */
    public function test_destroy_authorized_by_owner()
    {
        // Create a user and a listing
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['owner_id' => $user->id]);


        // Act as the user and call the destroy method
        $response = $this->actingAs($user)->delete(route('listing.destroy', $listing));

        // Assert the listing is deleted and the user is redirected
        $response->assertRedirect(route('listing.index'));
        $this->assertDatabaseMissing('listings', ['id' => $listing->id]);
    }

    /*
    * Negative test case, a user tries to delete a listing that they do not own
    */
    public function test_destroy_unauthorized_by_user_no_owner()
    {
        // Create a user and a listing
        $user = User::factory()->create();
        $listing = Listing::factory()->create(['owner_id' => $user->id]);
        $user2 = User::factory()->create();

    
        // Act as the user and call the destroy method
        $response = $this->actingAs($user2)->delete(route('listing.destroy', $listing));

        // Assert the user is redirected with an error message
        $response->assertRedirect(route('listing.show', $listing->id));
        $response->assertSessionHas('error', 'You do not own this listing, so you cannot delete it!');
    }
}