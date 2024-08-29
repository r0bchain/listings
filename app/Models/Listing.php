<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Listing extends Model
{
    use HasFactory, SoftDeletes; 

    // Allows mass assignment

    protected $fillable = [
        'beds', 'baths', 'area', 'beds', 'city', 'code', 'street', 'street_nr', 'price'
    ];

    protected $sortable = [
        'price', 'created_at'
    ];

    /**
     * Get the user that owns the Listing
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ListingImage::class);
    }   

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'listing_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeMostRecent(Builder $query): Builder
    {   
        return $query->latest();
    }

    /*
    * Scope a query to only include listings that have not been sold.
    */
    public function scopeWithOutSold(Builder $query): Builder
    {
        // return $query->doesntHave('offers')->orWhereHas('offers', function ($query) {
        //     $query->whereNull('accepted_at')->whereNull('rejected_at');
        // });
        
        // Adding sold_at to the listing table simplifies the query
        return $query->whereNull('sold_at');
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        // Useful for a search bar
        // $query->when($filters['search'] ?? false, function ($query, $search) {
        //     $query->where('city', 'like', '%' . $search . '%')
        //         ->orWhere('code', 'like', '%' . $search . '%')
        //         ->orWhere('street', 'like', '%' . $search . '%');
        // });

        return $query->when(
            $filters['priceFrom'] ?? false, 
            // Only executed in the first expression is TRUE.
            fn ($query, $value) => $query->where('price', '>=', $value)
        )->when(
            $filters['priceTo'] ?? false, 
            // Only executed in the first expression is TRUE.
            fn ($query, $value) => $query->where('price', '<=', $value)
        )->when(
            $filters['beds'] ?? false, 
            // Only executed in the first expression is TRUE.
            fn ($query, $value) => $query->where('beds', (int)$value < 6 ? '=' : '>=', $value)
        )->when(
            $filters['baths'] ?? false, 
            // Only executed in the first expression is TRUE.
            fn ($query, $value) => $query->where('baths', (int)$value < 6 ? '=' : '>=', $value)
        )->when(
            $filters['areaFrom'] ?? false, 
            // Only executed in the first expression is TRUE.
            fn ($query, $value) => $query->where('area', '>=', $value)
        )->when(
            $filters['areaTo'] ?? false, 
            // Only executed in the first expression is TRUE.
            fn ($query, $value) => $query->where('area', '<=', $value)
        )->when(
            $filters['deleted'] ?? false, 
            // Only executed in the first expression is TRUE.
            fn ($query, $value) => $query->onlyTrashed()
        )->when(
            $filters['by'] ?? false,
            fn ($query, $value) =>
            !in_array($value, $this->sortable)
                ? $query :
                $query->orderBy($value, $filters['order'] ?? 'desc')
        )->when(
            $filters['categoryId'] ?? 1,
            fn ($query, $value) => $query->where('category_id', '=',  $value)

        );

    }
          
}
