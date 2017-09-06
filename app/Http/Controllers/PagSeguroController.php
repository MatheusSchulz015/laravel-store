<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\PagSeguro;
use App\Order;
use App\Cart;
class PagSeguroController extends Controller
{
    //

public function pagseguro(PagSeguro $pagseguro){

$code = $pagseguro->generate();

$urlRedirect = config('pagseguro.url_redirect_after_request').$code;

	return redirect()->away($urlRedirect);

}

public function lightbox()
{
	return view('pagseguro-lightbox');
}

public function lightbotxCode(PagSeguro $pagseguro){

	return $pagseguro->generate();
}
public function transparente(PagSeguro $pagseguro){

	return view('pagseguro-transparente');
}
public function getCode(PagSeguro $pagseguro){

	$code = $pagseguro->getSessionId();

	return $code;
}
public function billet(Request $request, PagSeguro $pagseguro,Order $order, Cart $cart){

$response = $pagseguro->paymentBillet($request->sendHash);


$cart = new Cart;
$order->newOrderProducts($cart,$response['reference'],$response['code']);


$cart->emptyCart();
return response()->json($response,200);
dd($response);


}

public function card(PagSeguro $pagseguro){
	return view('pagseguro-transparente-card');


}

public function cardTransaction(PagSeguro $pagseguro,Request $request){
	$tokenCard = $request->tokenCard; 
	$sendHash = $request->sendHash; 
	//dd($request->all());
return $pagseguro->paymentcard($sendHash,$tokenCard);

}
}
