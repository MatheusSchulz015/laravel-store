<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client as Guzzle;

class PagSeguro extends Model
{
  use PagSeguroTrait;
  private $cart, $reference, $user;

  protected $currency = 'BRL';
  public function __construct(Cart $cart)
  {
      $this->cart = $cart;
      $this->reference = uniqid(date('YmdHis'));
      $this->user = auth()->user();
  }
    //
    public function generate(){
   
   $params = [

          
           'currency' => $this->currency,
            'reference' => $this->reference,
            
        ];



     $guzzle = new Guzzle;


   
    $url = config('pagseguro.url_checkout');
     //juntando arrays 
    $params = array_merge($params,$this->getConfigs());
    $params = array_merge($params,$this->getItems());
    $params = array_merge($params,$this->getSender());
    $params = array_merge($params,$this->getShipping());
   
	$query = http_build_query($params);

	$response = $guzzle->request('POST',$url, [
     	"form_params" => $params,
     	'verify' => true,
     	]);

  $body = $response->getBody();
  $contents = $body->getContents();
//passando para json
  $xml = simplexml_load_string($contents);

 $code = $xml->code;

 return $code;
    }

public function getSessionId(){

$params = [
            'email' => config('pagseguro.email'),
           'token' => config('pagseguro.token'),
            
           
        ];

     $guzzle = new Guzzle;

    $url = config('pagseguro.url_transparente_session');
    $query = http_build_query($params);

    $response = $guzzle->request('POST',$url, [
        "form_params" => $params,
        'verify' => true,
        ]);

  $body = $response->getBody();
  $contents = $body->getContents();
//passando para json
  $xml = simplexml_load_string($contents);

 $code = $xml->id;

return $code;
}

public function paymentBillet($sendHash){

  $params = [ 

          'senderHash' => $sendHash,
          'currency' => $this->currency,
          'paymentMode' => 'default',
          'paymentMethod' => 'boleto',      
          'reference' => $this->reference,
        ];

     $guzzle = new Guzzle;


   
    $url = config('pagseguro.url_payment_transparente');
    //juntando arrays 
    $params = array_merge($params,$this->getConfigs());
    $params = array_merge($params,$this->getItems());
    $params = array_merge($params,$this->getSender());
    $params = array_merge($params,$this->getShipping());
  $query = http_build_query($params);

  $response = $guzzle->request('POST',$url, [
      "form_params" => $params,
            ]);

$body = $response->getBody();
  $contents = $body->getContents();
//passando para json
  $xml = simplexml_load_string($contents);

 return [
  'success' => true,
  'payment_link' => (string)$xml->paymentLink,
  'reference' => $this->reference,
  'code' =>  (string)$xml->code,
 ];

}

public function paymentCard($sendHash,$cardToken){

  $params = [ 

  'token' => config('pagseguro.token'),
            'email' => config('pagseguro.email'),
           'currency' => 'BRL',
           'senderHash' => $sendHash,
           'paymentMode' => 'default',
           'paymentMethod' => 'creditCard',
           'senderCpf'=>'1234568944',
            'itemId1' => '0001',
            'itemDescription1' => 'Produto PagSeguroI',
            'itemAmount1' => 300021.45,
            'itemQuantity1' => '1',
            'itemWeight1' => '1000',
            
            'reference' => 'REF1234',
           
            'senderName' => 'Jose Comprador',
            'senderAreaCode' => '99',
            'senderPhone' => '99999999',
             'senderCPF' => '11475714734',
            'senderEmail' => 'c34725719695968397115@sandbox.pagseguro.com.br',
            'shippingType' => '1',
            'shippingAddressStreet' => 'Av. PagSeguro',
            'shippingAddressNumber' => '9999',
            'shippingAddressComplement' => '99o andar',
            'shippingAddressDistrict' => 'Jardim Internet',
            'shippingAddressPostalCode' => '99999999',
            'shippingAddressCity' => 'Cidade Exemplo',
            'shippingAddressState' => 'SP',
            'shippingAddressCountry' => 'ATA',

            'creditCardToken'=>$cardToken,
            'installmentQuantity'=>1,
            'installmentValue'=>300021.45,
            'noInterestInstallmentQuantity'=>2,
            'creditCardHolderName'=>'Jose Comprador',
            'creditCardHolderCPF'=>'11475714734',
            'creditCardHolderBirthDate'=>'01/01/1900',
            'creditCardHolderAreaCode'=>99,
            'creditCardHolderPhone'=>99999999,
            'billingAddressStreet'=>'Av. PagSeguro',
            'billingAddressNumber'=>9999,
            'billingAddressComplement'=>'99o andar',
            'billingAddressDistrict'=>'Jardim Internet',
            'billingAddressPostalCode'=>99999999,
            'billingAddressCity'=>'Cidade Exemplo',
            'billingAddressState'=>'SP',
            'billingAddressCountry'=>'ATA',
        ];

     $guzzle = new Guzzle;


   
    $url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions';
  $query = http_build_query($params);

  $response = $guzzle->request('POST',$url, [
      "form_params" => $params,
            ]);

$body = $response->getBody();
  $contents = $body->getContents();
//passando para json
  $xml = simplexml_load_string($contents);

 dd($xml);
  }


  public function getStatusTransaction($notificationCode)
  { 
        $params = [
           
            
        ];



     $guzzle = new Guzzle;


   
    $url = config('pagseguro.url_notification').'/'.$notificationCode;
   
    $params = $this->getConfigs();

  
  $query = http_build_query($params);
 
  $response = $guzzle->request('GET',$url, [
      "query" => $params,
      
      ]);


  $body = $response->getBody();
  $contents = $body->getContents();

//passando para json
  $xml = simplexml_load_string($contents);

 
 return [

 'status' => (string) $xml->status,
 'reference' => (string) $xml->reference,
];
  }
}


