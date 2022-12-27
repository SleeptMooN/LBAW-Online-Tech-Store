<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $table = "cart";

    public function product()
    {
       return $this->belongsTo('App\Models\Product');
    }
}

