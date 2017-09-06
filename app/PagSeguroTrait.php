<?php 

namespace App;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client as Guzzle;

trait PagSeguroTrait
{
	public function getConfigs()
	{
    return [
      'email' => config('pagseguro.email'),
      'token' => config('pagseguro.token'),
    ];
	}

	public function setCurrency($currency)
	{
		$this->currency = $currency;
	}

	public function getItems()
	{			
		$items = [];
		//pegando dados do carrinho

		$position = 1;
			$itemsCart = $this->cart->getItems();
			foreach ($itemsCart as $item) {
				$items["itemId".$position] = $item['item']->id;
				$items["itemDescription".$position] = $item['item']->description;
				$items["itemAmount".$position] =  number_format($item['item']->price, 2, '.', '');
				$items["itemQuantity".$position] = $item['qtd'];
				
				$position++;
			}

			return $items;

		/*return [
			'itemId1' => '0001',
            'itemDescription1' => 'Produto PagSeguroI',
            'itemAmount1' => '99999.99',
            'itemQuantity1' => '1',
            'itemWeight1' => '1000',
            'itemId2' => '0002',
            'itemDescription2' => 'Produto PagSeguroII',
            'itemAmount2' => '99999.98',
            'itemQuantity2' => '2',
            'itemWeight2' => '750',
            ];*/
	}

	public function getSender()
	{
		return [
			'senderName' => $this->user->name,
            'senderAreaCode' => $this->user->area_code,
            'senderPhone' => $this->user->phone,
             'senderCPF' => $this->user->cpf,
            'senderEmail' => $this->user->email,
		];
	}

	public function getShipping()
	{

		return[
			'shippingType' => '1',
            'shippingAddressStreet' => $this->user->street,
            'shippingAddressNumber' => $this->user->number,
            'shippingAddressComplement' => $this->user->complement,
            'shippingAddressDistrict' => $this->user->district,
            'shippingAddressPostalCode' => $this->user->postal_code,
            'shippingAddressCity' => $this->user->city,
            'shippingAddressState' => $this->user->state,
            'shippingAddressCountry' => $this->user->country,
		];
	}
}
 ?>
