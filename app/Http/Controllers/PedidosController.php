<?php

namespace App\Http\Controllers\Web;

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
       $carts = Cart::all();

       return view('admin.pedidos.pedidos', compact('carts'));
    }

    public function pedidos()
    {   

        $user = auth()->user();
        $carts = Cart::orderBy('id', 'DESC')
        ->paginate()
        ->where('user_id', $user->id);

        return view('web.pedidos', compact('carts'));
    }

    public function pedido($id)
    {   
        $user = Cart::find($id);
        $this->authorize('pasale', $user);

        $productos = CartDetail::get()->where('cart_id', $id);

        $totalProductos = CartDetail::where('cart_id', $id)->sum('quantify');

        $total = CartDetail::where('cart_id', $id)->sum('subtotal');

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
