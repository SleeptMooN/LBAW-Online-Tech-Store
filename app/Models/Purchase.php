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
    protected $fillable = ['totalcost', 'quantity', 'product_id','order_id'];

    
    public function product()
    {
       return $this->belongsTo('App\Models\Product');
    }
}