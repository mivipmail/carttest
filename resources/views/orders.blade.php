@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center mb-3">
        <h2 class="h2">
            Заказы
        </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="list-group">
                @foreach ($orders as $order)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 ml-3">
                            <div class="fw-bold">#{{ $order['id'] }}</div>
                            <small>{{ $order['created_at'] }}</small>
                        </div>
                        <ul>
                            @foreach($order['items'] as $item)
                                <li>{{ $item['product']['title'] }} - {{ $item['quantity'] }} шт.</li>
                            @endforeach
                        </ul>
                        <div class="ms-auto fw-bold">
                            <div>{{ number_format($order['sum'], 0, '', ' ') }} руб.</div>
                            <form action="{{ route('order.destroy', ['id' => $order['id']]) }}" method="post" class="d-flex flex-column align-items-end mb-1">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-success btn-sm">Удалить</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between bg-dark text-white fw-bold">
                        <div>ИТОГО:</div> 
                        <div>{{ number_format($ordersSum, 0, '', ' ') }} руб.</div>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
