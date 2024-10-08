<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{
    public function before(?User $user, $ability): ?bool

    {
        // Previous to PHP 8.0       
        // if ($user $$ $user->is_admin) {
        // Null coalescing operator (if null it won't throw an error)
        if ($user?->is_admin /*&& $ability === 'update'*/) {
            return true;
        }

        return null;
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Listing $listing): Response
    {   
        if($listing->owner_id === $user?->id) {
            return Response::allow();
        }

       // dd($listing->sold_at );
       // Users different than the owner can only see listings that are not sold
       return ($listing->sold_at === null) 
            ? Response::allow()  
            : Response::denyWithStatus(404);

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): Response
    {   
        return ($user->id) 
        ? Response::allow()
        : Response::deny('You are not logged.');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Listing $listing): Response
    {
        return ($user->id === $listing->owner_id)
        ? Response::allow()
        : Response::deny('You do not own this listing!');

    }
 
    /**
     * Determine whether the user can update the model.
     */
    public function updateAccepted(User $user, Listing $listing): Response
    {
        return ($listing->sold_at === null)
        ? Response::allow()
        : Response::deny('An offer was already chosen!');

    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Listing $listing): Response
    {
        return $user->id === $listing->owner_id
        ? Response::allow()
        : Response::deny('You do not own this listing, so you cannot delete it!');
    }

     /**
     * Determine whether the user can delete the model.
     */
    public function hard_delete(User $user, Listing $listing): Response
    {
        return $user->id === $listing->owner_id
        ? Response::allow()
        : Response::deny('You do not own this listing, so you cannot hard delete it!');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Listing $listing): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Listing $listing): bool
    {
        //
    }
}
