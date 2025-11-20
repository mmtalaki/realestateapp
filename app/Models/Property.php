<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['title', 'address', 'city', 'county', 
    'price', 'bedrooms', 'bathrooms', 'sq_meters', 'type', 'status', 'user_id'];
}
