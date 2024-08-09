@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-center mb-3">
        <h2 class="h2">
            Корзина
        </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ol class="list-group list-group-numbered">
                @foreach ($cartProducts as $product)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{ $product->title }}</div>
                        </div>
                        <div>{{ $cart[$product->id] }} шт. х {{ number_format($product->price, 0, '', ' ') }} руб.</div>
                    </li>
                @endforeach
            </ol>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between bg-dark text-white fw-bold">
                        <div>ИТОГО:</div> 
                        <div>{{ number_format($cartSum, 0, '', ' ') }} руб.</div>
                </li>
                <li class="list-group-item d-flex justify-content-end border-0 pe-0">
                    <form action="{{ route('order.store') }}" method="post" class="d-flex flex-column align-items-start">
                        @csrf
                        <button type="submit" class="btn btn-success">Оформить заказ</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
