@extends('store.layouts.main')

@section('content')
<h2>Metodo de pagamento</h2>
<button onclick="paymentLightBox()" class="btn btn-primary" >Pagar com lightbox</button>
<button data-toggle="modal" data-target="#squarespaceModal" class="btn btn-primary">Cartao</button>
<a href="#" id="payment-billet" class="btn btn-primary" >Boleto</a>
 



<!-- line modal -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Fechar</span></button>
			<h3 class="modal-title" id="lineModalLabel">Pagamento com Cartão</h3>
		</div>
		<div class="modal-body">
			
            <!-- content goes here -->
			<form>
              <div class="form-group col-md-5">
                <label for="exampleInputEmail1">Nome no cartão</label>
                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Nome do Titular do cartão">
              </div>
              <div class="form-group col-md-5">
                <label for="exampleInputPassword1">Numero do Cartao</label>
                <input type="text"  class="form-control" id="cardNumber" placeholder="Numero do cartão">
      </div>
              <div class="form-group col-md-3">
                <label for="exampleInputPassword1">Validade</label>
                <input type="text" id="validadeMes" class="form-control"  placeholder="Mês"  maxlength="2">

                </div>

                <div class="form-group col-md-3">
                <label for="exampleInputPassword1">Ano</label>
                <input maxlength="4" id="validadeAno" type="text" class="form-control"  placeholder="Ano">
              </div>

                <div class="form-group col-md-3">
                <label for="exampleInputPassword1">CVV</label>
                <input maxlength="3" type="text" id="CVV" class="form-control"  placeholder="Ano">
              </div>
         
              
            </form>

		</div>
		<div class="modal-footer">
			<div class="btn-group btn-group-justified" role="group" aria-label="group button">
				<div class="btn-group" role="group">
					<button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
				</div>
				<div class="btn-group btn-delete hidden" role="group">
					<button type="button" id="delImage" class="btn btn-default btn-hover-red" data-dismiss="modal"  role="button">Delete</button>
				</div>
				<div class="btn-group" role="group">
					<button type="button" id="cardPayment" class="btn btn-default btn-hover-green" data-action="save" role="button">Pagar</button>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>

{!! Form::open(['id=form'])  !!}
{!!Form::close() !!}


@endsection

@push('scripts')
<script type="text/javascript" src='{{config('pagseguro.url_transparente_js')}}'></script>
        

<script type="text/javascript">
	$(function(){
		$('#payment-billet').click(function(){
				setSessionId('billet');
				//getPaymentMethods();
			return false;
		});
	});

	function setSessionId(tipo,param)
	{
		//pegar o campo token
		var data = $('#form').serialize();

		$.ajax({
			url: "{{url('/pagseguro-transparente')}}",
			method:"POST",

			data: data,
		}).done(function(data){
			//console.log(data);
			PagSeguroDirectPayment.setSessionId(data);
			switch(tipo) {
    case 'card':
        paymentCard(param)
        break;
    case 'billet':
        paymentBillet()
        break;
    default:
       alert('default')
} 
			//getPaymentMethods();
			//paymentBillet();
		}).fail(function(data){
			alert("Falha na requisição");
		});
	}


	function paymentBillet()
{
		var sendHash = PagSeguroDirectPayment.getSenderHash();
		var data = $('#form').serialize()+"&sendHash="+sendHash;


		$.ajax({
			url: "{{url('/pagseguro-billet')}}",
			method:"POST",

			data: data,
		}).done(function(data){
			if (data.success)
			{
				window.location.href=data.payment_link;
			}else
			{
				alert('Falha no pagamento');
			}
		}).fail(function(data){
			alert("Falha na requisição");
		});
}


	function getPaymentMethods(){
		PagSeguroDirectPayment.getPaymentMethods({
			amount: 10,
			success : function(response){
				if (response.error == false) {
					$.each(response.paymentMethods, function(key, value){
						console.log(key);
					});
				}
			},
			 error: function(response){
			 		console.log(response);
			},
			complete:function(response){
				//console.log(response);
			}
		});
	}

$(function(){
		$('#cardPayment').click(function(){
				
				var param = {
    cardNumber: $("input#cardNumber").val(),
    brand : 'visa',
    cvv: $("input#CVV").val(),
    expirationMonth: $("input#validadeMes").val(),
    expirationYear: $("input#validadeAno").val(),
    success: function(response) {
    	console.log(response);
        //token gerado, esse deve ser usado na chamada da API do Checkout Transparente
    },
    error: function(response) {
    	console.log(response);
        //tratamento do erro
    },
    complete: function(response) {
        //tratamento comum para todas chamadas
    }
}			
		setSessionId('card',param);

				
			return false;
		});
	});

function paymentLightBox(){
	var data = $('#form').serialize();
		$.ajax({
			url: "{{url('/pagseguro-lightbox')}}",
			method:"POST",
			data: data,
		}).done(function(data){

			lightbox(data);
		}).fail(function(data){
			alert("Falha na requisição");
		});

}

function paymentCard(param){
	PagSeguroDirectPayment.createCardToken(param);
	PagSeguroDirectPayment.getInstallments({
    amount: 600,
    brand: 'visa',
    maxInstallmentNoInterest: 12,
    success: function(response) {
        //opções de parcelamento disponível

    },
    error: function(response) {
        //tratamento do erro
    },
    complete: function(response) {
        //tratamento comum para todas chamadas
        console.log(response);
    }
});
}



function lightbox(code){
		var isOpenLightbox = PagSeguroLightbox({
			code: code

		}, {
			success: function(transactionCode){
				alert("Pedido realizado com sucesso "+ transactionCode);

			}, abort: function(){
				alert("compra Abortada");
			}
		});

		if (!isOpenLightbox) {

			location.href="{{config('pagseguro.url_redirect_after_request')}}"+code;
		}
	}
</script>
@endpush

 <script type="text/javascript"
            src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>