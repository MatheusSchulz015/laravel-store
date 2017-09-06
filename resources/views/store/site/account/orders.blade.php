
@extends('store.layouts.main')

@section('content')
<div class="container">
	<div class="row">
		<div class="table-responsive">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID</th>
            <th>Referencia</th>
            <th>Status</th>
            <th>EmForma de pagamento</th>
            <th>Data</th>
            <th>Data de atualização</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
        @forelse($orders as $order)
          <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->reference}}</td>
            <td>{{$order->getStatus($order->status)}}</td>
            <td>{{$order->getPaymentMethod($order->payment_method)}}</td>
            <td>{{$order->date
              }}</td>
            <td>{{$order->getDateRefreshAttribute($order->date_refresh_status)}}</td>
            <td><button class="btn btn-info">Detalhes</button></td>
          </tr>
          @empty
          <p>Nenhum Pedido!</p>
          @endforelse
        </tbody>
      </table>
    </div>
	</div>
</div>
@endsection