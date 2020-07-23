<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Cart;
use App\CartDetail;
use App\User;
use Carbon\Carbon;

class PedidosController extends Controller
{
    public function __construct()
    {   
        $this->middleware('auth');
    }

    public function adminPedidos()
    {
      $cartsCancelados = Cart::OrderBy('id', 'DESC')
      ->where('status', 'Cancelado')
      ->paginate(5);

       $cartsEntregados = Cart::OrderBy('id', 'DESC')
       ->where('status', 'Entregado')
       ->paginate(5);

       $cartsPending = Cart::OrderBy('id', 'DESC')
       ->where('status', 'En camino')
       ->paginate(5);

       return view('admin.pedidos.pedidos', compact('cartsCancelados', 'cartsEntregados' ,'cartsPending'));
    }

    public function pedidos()
    {   
        //$order = \DB::select('select * from orders WHERE ');// aqui te quedaste
        $user = auth()->user();
        $carts = Cart::orderBy('id', 'DESC')
        ->paginate()
        ->where('user_id', $user->id);

        return view('web.pedidos', compact('carts'));
    }

    public function pedido(Cart $cart)
    {   
        // $cart = Cart::find($id);
        //$this->authorize('pasale', $user);

        $productos = CartDetail::get()->where('cart_id', $cart->id);

        $totalProductos = CartDetail::where('cart_id', $cart->id)->sum('quantify');

        $total = CartDetail::where('cart_id', $cart->id)->sum('subtotal');

        return view('web.pedido', compact('productos', 'totalProductos', 'total'));
    }

    public function detalles($pedido, $usuario)
        // muestra los detalles del pedido enviado via email
    { 
        $user = User::where('id', $usuario)->first();
        $cart = Cart::where('id', $pedido)->first();

        $totalProductos = CartDetail::where('cart_id', $pedido)->sum('quantify');
        $total = CartDetail::where('cart_id', $pedido)->sum('subtotal');

        return view('admin.pedidos.detalles', compact('cart','user', 'totalProductos', 'total'));
    }

    public function cancelar(Request $request)
        // cancela el$ pedido
    { 

      $cart = auth()->user()->cart->where('id', $request->id)->first();
  
      if($cart) {
        $cart->status = 'Cancelado';
        $cart->cancel_order = Carbon::now();
        $cart->save();
      }
      //enviar correo de cancelacion
      alert()->success('Pedido Cancelado');
      return back();
    
    }

    public function entregado(Request $request)
        // entregado 
    { 

      $cart = auth()->user()->cart->where('id', $request->id)->first();
  
      if($cart) {
        $cart->status = 'Entregado';
        $cart->arrived_date = Carbon::now();
        $cart->save();
      }

      //enviar correo de confirmacion
      alert()->success('Pedido Entregado');
      return back();
    
    }

}
