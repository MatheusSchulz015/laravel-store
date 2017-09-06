<?php 

$enviroment  = env('PAGSEGURO_ENVORIMENT');
$isSandbox = ($enviroment == 'sandbox') ? true : false;

$urlLightBox = ($isSandbox) ? 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js' : 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js';
$urlTransparenteSession =  ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions' : 'https://ws.pagseguro.uol.com.br/v2/sessions';

$urlTransparente_js = ($isSandbox) ? 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js' : 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js';
$urlPaymentTransparente = ($isSandbox) ?  'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions' : 'https://ws.pagseguro.uol.com.br/v2/transactions';

$urlNotification = ($isSandbox) ? 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/notifications' : 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications';


return [
	'enviroment'=>env("PAGSEGURO_ENVORIMENT"),
	'email' => env('PAGSEGURO_EMAIL'),
	'token' => env("PAGSEGURO_TOKEN"),
	'url_checkout'=>'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout',

	'url_redirect_after_request'=>'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=',
	
	'url_lightbox' => $urlLightBox,


	'url_transparente_session' => $urlTransparenteSession,

	'url_notification' => $urlNotification,


	'url_transparente_js' =>$urlTransparente_js,

	
//efutar pagamento
	'url_payment_transparente'=> $urlPaymentTransparente,
	
]
 ?>