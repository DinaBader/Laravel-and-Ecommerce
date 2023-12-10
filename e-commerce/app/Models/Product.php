<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'user_id',
        'product_description',
        'product_price',
        'stock_quantity'
    ];

    public function users()
{
    return $this->belongsTo(User::class);
}


}      

