<?php

namespace Database\Factories\Providers;

use Faker\Provider\Base;

class CategoryFakerProvider extends Base
{
    public function category()
    {
        $data = [
            'Real State',
            'Bussines for sell or rent',
            'Cars & Vehicles',
            'Jobs',
            'Boats',
            'Services',
            'Sport equipment',
            'Other'


        ];

        return $this->generator->randomElement($data);
    }
}
