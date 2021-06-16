<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Country extends Model
{
    protected $fillable = [
        'iso', 'name', 'nice_name', 'iso3', 'num_code', 'phone_code'
    ];
}
