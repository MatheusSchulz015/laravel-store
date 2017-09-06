<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PagSeguro;
use App\Order;
class ApiPagseguroController extends Controller
{
    //
    public function request(Request $request, PagSeguro $pagseguro, Order $order)
    {

    	if (!$request->notificationCode) {
    		return response()->json(['error'=>'Not notificationCode'],400);
    	}
    	$response =  $pagseguro->getStatusTransaction($request->notificationCode);

    	//dd($order->where('reference',$response['reference'])->get()->first());
    	$order->updateStatus($response['reference'],$response['status']);
    }
}
