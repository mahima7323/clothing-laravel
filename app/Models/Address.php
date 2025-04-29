<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Fillable fields for mass assignment
    protected $fillable = ['user_id', 'street', 'city', 'state', 'zip_code', 'country'];
}
