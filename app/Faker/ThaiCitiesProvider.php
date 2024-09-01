<?php

namespace App\Faker;

use Faker\Provider\Base;

class ThaiCitiesProvider extends Base
{
    protected static $thaiCities = [
        'Bangkok', 'Chiang Mai', 'Phuket', 'Pattaya', 'Ayutthaya', 'Hua Hin', 'Krabi', 'Surat Thani', 'Nakhon Ratchasima', 'Udon Thani'
    ];


    public function thaiCity()
    {
        return static::randomElement(static::$thaiCities);
    }
}