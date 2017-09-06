<?php

namespace App\Http\Controllers;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
use App\User;
use App\Order;
class StoreController extends Controller
{
    //

    public function index(Product $features)
    {
    	$features = Product::all();
    	return view('store.home.index',compact('features'));
    }

   public function cart(){
   		$title = "Carrinho | Laravel Store";
   		$cart = new Cart;

   		//dd($products = $cart->getItems());
   		$products = $cart->getItems();
   		//dd($cart->total());
   		//dd($cart->totalItems());
    	return view('cart',compact('title','cart','products'));
    }
    public function login(){
   		$title = "Log::warning('message'); | Laravel Store";
    	return view('login',compact('title'));
    }

    public function methodPayment(){
      $title = "Escolha um metodo de pagamento";
      return view('store.site.payment.method-payment',compact('title'));
    }

 //colocar no controller do usuario
    public function orders(Order $order, User $user){
      
      $ordem = new Order();
      $orders = auth()->user()->orders;
     
      return view('store.site.account.orders',compact('orders'));
    }

   




}
