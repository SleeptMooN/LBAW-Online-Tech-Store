<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    
    public $timestamps  = false;
    protected $table = "address";
    protected $fillable = ['housenumber', 'postalcode', 'city', 'country','users_id'];


    public function user()
    {
       return $this->belongsTo('App\Models\User');
    }

    public function orders()
    {
       return $this->belongsTo('App\Models\Order');
    }
}