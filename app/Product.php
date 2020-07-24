<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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

    public static function setFile($file){
        if($file){
            $imageName = Str::random(20). '.jpg';
            $imagen = Image::make($file)->encode('jpg',75);
            $imagen->resize(800, 800, function($constraint){
                $constraint->upsize();
            });
            Storage::disk('public')->put("image/$imageName", $imagen->stream());
            return $imageName;
        }else{
            return false;
        }
    }
}
