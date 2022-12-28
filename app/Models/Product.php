<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = "product";
    protected $fillable = ['name', 'description', 'price', 'tsvectors'];

    
    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }
}