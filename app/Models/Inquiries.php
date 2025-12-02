<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inquiries extends Model
{
    protected $fillable = ['inquiry', 'user_id', 'property_id'];
}
