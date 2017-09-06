<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Session;
class CartController extends Controller
{
    //

    public function add($id)
    {
    	$product = Product::find($id);
    	//senao encontrar o produto, volte
    	if (!$product) {
    		return redirect()->back();
    	}
    	$cart  = new Cart;

    	$cart->add($product); 

    	//criando sessão
    	Session::put('cart',$cart);
    	return redirect('/cart');
   	}

   	public function remove($id)
   	{
   		$product = Product::find($id);
    	//senao encontrar o produto, volte
    	if (!$product) {
    		return redirect()->back();
    	}
    	$cart  = new Cart;

    	$cart->remove($product);
    	Session::put('cart',$cart);
    	return redirect('/cart');
   	}


}
