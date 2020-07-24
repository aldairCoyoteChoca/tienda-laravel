<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartAddRequest;
use Carbon\Carbon;
use App\CartDetail;
use App\Cart;
use App\User;
use App\Product;
use App\Mail\NewOrder;
use App\Mail\NewOrden;
use Mail;
use Alert;

use Caffeinated\Shinobi\Models\Role;

class CarShopController extends Controller
{
  public function __construct()
  {   
    $this->middleware('auth');
  }

  //muestra el contenido del carrito
  public function index()
  {

    $address      =  auth()->user()->address;
    $postal_code  =  auth()->user()->postal_code;

    if ($address && $postal_code) {
      $total = auth()->user()->cart->details->sum('quantify');
      if ($total === 0) {
          alert()->info('¡Agrega algún producto!', 'Tu carrito esta vacío');
          return redirect('productos');
      }else{
        $products = auth()->user()->cart->details;
    
        return view('web/carshop', compact('products'));
      }
    }else{
      alert()->info('Completa tus datos para ordenar', '¡Por favor!');
      return redirect(route('user.edit', auth()->user()->id));
    }
  }

  //actualiza la cantidad ya existente
  public function update(Request $request)
  {      
    $cart   = auth()->user()->cart;
    $detail = $cart->details()->where('product_id', $request->product_id)->first();

    if($request->ajax()){
      if($detail){
        $detail->quantify = $request->quantify;
        $detail->subtotal = $detail->quantify * $detail->price;
        $detail->save();
      }
      $cartDetailTotal = auth()->user()->cart->details->sum('quantify');
      $total = auth()->user()->cart->total;
      return response()->json([
        'message' => 'Producto actualizado.',
        'total_productos' => $cartDetailTotal,
        'subtotal' => $detail->subtotal,
        'total' => $total,
        'id' => $detail->product_id
      ]);
    }
  }

  //añade un producto al carrito
  public function add(Request $request, Product $product)
  {   
    $cart   = auth()->user()->cart;
    $detail = $cart->details()->where('product_id', $request->product_id)->first();

    if($request->ajax()){
      if($detail) {
        if($detail->quantify + $request->quantify > $detail->product->stock) {
          // alert()->info('Compralo antes de que alguien más lo haga', 'Ya no hay :c');
          //toast('Compralo antes de que alguien más lo haga', 'Ya no hay :c','info');
        } 
        else {
          $detail->quantify += $request->quantify;
          $detail->subtotal = $detail->quantify * $detail->price;
          $detail->save();
        }
      } 
      else {
        $cartDetail           = new CartDetail();
        $cartDetail->cart_id  = auth()->user()->cart->id;
        $cartDetail->product_id  = $request->product_id;
        $cartDetail->quantify = $request->quantify;
        $cartDetail->price   = $request->price;
        $cartDetail->subtotal = $cartDetail->price * $cartDetail->quantify;
        $cartDetail->save();
      }
      $cartDetailTotal = auth()->user()->cart->details->sum('quantify');
      return response()->json([
        'message' => 'Producto agregado al carrito.',
        'total_productos' => $cartDetailTotal
      ]);
    }
  }

  // Destruye/elimina un producto de carrito
  public function destroy(Request $request, CartDetail $cartDetail)
  {    
    if($request->ajax()){
      if($cartDetail->cart_id == auth()->user()->cart->id){
        $cartDetail->delete();
        $cartDetailTotal = auth()->user()->cart->details->sum('quantify');
        $total = auth()->user()->cart->total;
      }
      return response()->json([
        'total_productos' => $cartDetailTotal,
        'total' => $total,
        'message' => 'Producto elminado'
      ]);
    }
  }

   //envia la orden por correo y actualiza los campos
   public function order(Request $request)
   {
     
    $client           = auth()->user();
    $cart             = $client->cart;
    $cart->status     = 'En camino';
    $cart->order_date = Carbon::now();
    $cart->save();

    $cart = auth()->user()->cart->where('id', $request->id)->first();
    $products = $cart->details;

    foreach($products as $product){
      $product->product->stock =  $product->product->stock - $product->quantify; 
      $product->product->save();

      if($product->product->stock == 0){
        // busque todos los registro del cardetail y si coinciden con el id del producto los elimine de los carritos
        $detail = CartDetail::where('product_id', $product->product->id);
        $carritos = Cart::all()->where('status', 'Active');
        foreach($carritos as $carrito){
          if($carrito->status == 'Active'){
            $detail->delete();
          }
        }
      }
    }
    $recibir_pedidos  = User::where('pedidos', 'RECIBIR')->get();
    Mail::to($recibir_pedidos)->send(new NewOrder($client, $cart));

    alert()->success('Pedido enviado');
    return redirect('productos');
  }
}
