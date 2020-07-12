<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Tag;

class PageController extends Controller
{
    public function index()
    {   
        $products = Product::orderBy('id', 'DESC')
        ->where('status', 'PUBLISHED')
        ->paginate(10);
        return view('web.products', compact('products'));
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->first();

        return view('web.product', compact('product'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->pluck('id')->first();

        $products = Product::where('category_id', $category)
        ->where('status', 'PUBLISHED')
        ->orderBy('id', 'DESC')
        ->paginate(10);

        return view('web.products', compact('products'));
    }

    public function tag($slug)
    {
        //'tags' es el metodo del modelo y $query el objeto para manipular los datos
        $products = Product::whereHas('tags', function($query) use($slug){
            $query->where('slug', $slug);
        })
        ->where('status', 'PUBLISHED')
        ->orderBy('id', 'DESC')
        ->paginate(10);

        return view('web.products', compact('products'));
    }
}
