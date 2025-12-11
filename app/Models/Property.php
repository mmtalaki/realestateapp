<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['title', 'description', 'address', 'city', 'county', 'price',
    'bedrooms', 'bathrooms', 'sq_meters', 'offer_type', 'property_type', 'status', 'year_built','latitude', 'longitude', 'user_id'];
}
