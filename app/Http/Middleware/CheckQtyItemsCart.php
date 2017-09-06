<?php

namespace App\Http\Middleware;

use Closure;
use App\Cart;
class CheckQtyItemsCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $cart = new Cart;
        $qtdCart = $cart->totalItems();

        if ($qtdCart < 1) {
            return redirect()->back()->with('message','Não existe nenhum item no carrinho');
        }
        return $next($request);
    }
}
