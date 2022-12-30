<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Model
{
    use HasFactory;
    
    public $timestamps  = false;
    protected $table = "purchase";
    protected $fillable = ['totalcost', 'quantity', 'product_id','orders_id'];

    
    public function products()
    {
       return $this->belongsTo('App\Models\Product');
    }
}