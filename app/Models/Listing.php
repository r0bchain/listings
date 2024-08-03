<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    use HasFactory;

    // Allows mass assignment

    protected $fillable = [
        'beds', 'baths', 'area', 'beds', 'city', 'code', 'street', 'street_nr', 'price'
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

    public function scopeMostRecent(Builder $query): Builder
    {
        return $query->latest();
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
        );
    }
}
