<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public function details() 
    {
        return $this->hasMany(CartDetail::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }

    public function getTotalAttribute()
    {
    	$total = 0;
    	foreach ($this->details as $detail) {
    		$total += $detail->quantify * $detail->product->price;
    	}
    	return $total;
    }
}

