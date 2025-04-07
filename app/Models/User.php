<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Specify the table name
    protected $table = 'users';

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'email',
        'password',
        'cno',
        'gender',
        'city',
    ];

    // Hidden attributes for arrays
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function wishlist()
{
    return $this->hasMany(Wishlist::class);
}

}
