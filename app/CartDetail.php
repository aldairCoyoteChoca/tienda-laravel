<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    protected $fillable = [
        'quantify', 'price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
