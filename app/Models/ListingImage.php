<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    use HasFactory;

    protected $fillable = ['filename'];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
}
