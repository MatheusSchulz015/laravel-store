<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

	protected $fillable = ['user_id','reference','code','status','payment_method','date'];
	 protected $dates = [
	 	'date'
	 ];
	 protected $dateFormat = 'd/m/y';

    
	public function products()
	{
		return $this->belongsToMany(Product::class,'product_order');
	}
//salvar nova ordem de produto
	public function newOrderProducts($cart,$reference,$code,$status=1,$paymentMethod=2)
	{
			$date = Carbon::createFromFormat('d/m/y H:i:s', date('d/m/y H:i:s'));
			$order = $this->create([
					'user_id' => auth()->user()->id,
					'reference' => $reference,
					'code' => $code,
					'status' => $status,
					'payment_method' => $paymentMethod,
					
				]);
			
			$productsOrder = [];
			$itmesCart = $cart->getItems();

			foreach ($itmesCart as $item ) {
				$productsOrder[$item['item']->id] = [
					'qty' =>$item['qtd'],
					'price' => $item['item']->price,
				];
			}

			$order->products()->attach($productsOrder);
	}

	public function getStatus($status)
	{
			$statusA = [
				'1' => 'Aguardando pagamento',
				'2' => 'Em análise',
				'3' => 'Paga',
				'4' => 'Disponível',
				'5' => 'Em disputa',
				'6' => 'Devolvida',
				'7' => 'Cancelada',

			];

			return $statusA[$status];
	}

	public function getPaymentMethod($payment)
	{
		$paymentA = [
			'1' => 'Cartão de crédito',
			'2' => 'Boleto',
			'3' => 'Cartão de crédito',
			'4' => 'Débito online (TEF)',
			'5' => 'Saldo PagSeguro',
			'6' => 'Oi Paggo',
			'7' => 'Depósito em conta',
		];
		//dd($payment);
		return $paymentA[$payment];

	}

//formatando data
	public function getDateAttribute($date)
	{
		//dd($date);

		return Carbon::parse($date)->format('d-m-Y H:i');
    
	}
	public function getDateRefreshAttribute($date)
	{
		//dd($date);
			if(!$date){
				return '';
			}
		return Carbon::parse($date)->format('d-m-Y H:i');
    
	}

//alterar status da ordem
	public function updateStatus($reference,$status)
	{

		$order= $this->where('reference',$reference)->get()->first();
		$order->status = $status;
		$order->date_refresh_status = date('Y-m-d H:i');
		$order->save();


	}

}
