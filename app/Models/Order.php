<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    public $timestamps  = false;
    protected $table = "orders";
    protected $fillable = ['name', 'email', 'status','users_id'];


    public function user()
    {
       return $this->belongsTo('App\Models\User');
    }
}