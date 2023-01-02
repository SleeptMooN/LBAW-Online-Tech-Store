<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = "review";

    protected $dates = ['date'];

    protected $fillable = [
        'title',
        'comment',
        'score',
        'users_id',
        'product_id',
    ];

    public function products()
    {
       return $this->belongsTo('App\Models\Product');
    }

    public function users()
    {
       return $this->belongsTo('App\Models\User');
    }
}
