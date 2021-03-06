<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Facades\Storage;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::OrderBy('id', 'DESC')
        ->paginate();

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->get();

        return view('admin.products.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        
        if($file = Product::setFile($request->file_up)){
            $request->request->add(['file' => "image/$file"]);
        }else{
            $request->request->add(['file' => "image/icons/productdefault.jpg"]);
        }

        $product = Product::create($request->all());
        //tags
        $product->tags()->attach($request->get('tags'));

        alert()->success('Producto creado con éxito');
        return redirect()->route('products.edit', $product->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name', 'ASC')->pluck('name', 'id');
        $tags = Tag::orderBy('name', 'ASC')->get();

        return view('admin.products.edit', compact('product', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        if($request->file_up){
            if($file = Product::setFile($request->file_up)){
                $request->request->add(['file' => "image/$file"]);
            }
            if($product->file !== 'image/icons/productdefault.jpg'){
                if(public_path("$product->file")){
                    unlink(public_path("$product->file"));
                }
            }
        }
        
        $product->fill($request->all())->save();
        //tags
        $product->tags()->sync($request->get('tags'));

        alert()->success('Producto actualizado con éxito');
        return redirect()->route('products.show', $product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        alert()->success('Producto eliminado con éxito');
        return back();
    }
}
