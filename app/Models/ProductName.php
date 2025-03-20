<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductName extends Model
{
    protected $table = 'product_name'; // Explicitly define the table name
    protected $fillable = ['name', 'description', 'price', 'quantity', 'image'];

    // Accessor to convert the image paths string into an array
    public function getImagesAttribute()
    {
        return $this->image ? explode('|', $this->image) : [];
    }
}
