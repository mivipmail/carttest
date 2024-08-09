@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('cart.index') }}" type="button" class="btn btn-secondary position-relative">
            Корзина
            @if($cartCount > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $cartCount }}
            </span>
            @endif
        </a>
    </div>
    <div class="d-flex justify-content-center mb-3">
        <h2 class="h2">
            Товары
        </h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ol class="list-group list-group-numbered">
                @foreach ($products as $product)
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                        <div class="fw-bold">{{ $product->title }}</div>
                        {{ number_format($product->price, 0, '', ' ') }} руб.
                        </div>
                        <form action="{{ route('cart.add', ['id' => $product->id]) }}" method="post" class="d-flex flex-column align-items-start">
                            @csrf
                            <select name="quantity" class="form-select form-select-sm w-auto text-center mb-1">
                                <option value="1" selected>1</option>
                                @for($i=2; $i<11; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                @endfor
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Добавить в корзину</button>
                        </form>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
@endsection
