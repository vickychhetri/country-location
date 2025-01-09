<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    use HasFactory;
    protected $table="postal_codes";
    protected $fillable = [
        'country', 'postal_code', 'city', 'province', 'province_abbr', 'latitude', 'longitude', 'time_zone'
    ];
}
