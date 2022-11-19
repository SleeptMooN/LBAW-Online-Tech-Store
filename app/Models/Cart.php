<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = "Cart";

    public function products()
    {
       return $this->hasMany('App\Models\Product');
    }
}
