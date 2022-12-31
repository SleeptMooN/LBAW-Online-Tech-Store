<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;


class WishList extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $table = "wishlist";

    protected $fillables = [
        'users_id',
        'product_id'
    ];

    public function products()
    {
       return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
