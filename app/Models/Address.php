<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    // In Address.php
    protected $fillable = ['user_id', 'street', 'city', 'state', 'zip_code', 'country'];

}
