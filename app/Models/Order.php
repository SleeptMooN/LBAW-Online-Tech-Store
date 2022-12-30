<?php

namespace App\Models;


use App\Models\User;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    
    public $timestamps  = false;
    protected $table = "orders";
    protected $fillable = ['name', 'email', 'status','totalcost','phone','trackingnumber','users_id'];


    public function user()
    {
       return $this->belongsTo('User');
    } 

    public function purchase()
    {
       return $this->hasMany('App\Models\Purchase');
    }
}