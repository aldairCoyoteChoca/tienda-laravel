<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id', 'category_id', 'name', 'slug',
        'excerpt', 'description', 'status', 'file', 'price', 'stock'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)->withTimestamps();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
