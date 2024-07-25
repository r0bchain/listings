<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    // Allows mass assignment

    protected $fillable = [
        'beds', 'baths', 'area', 'beds', 'city', 'code', 'street', 'street_nr', 'price'
    ];
}
