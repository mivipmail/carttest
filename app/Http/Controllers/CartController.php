<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $session = request()->session();
        $cart = ($session->has('cart')) ? $session->get('cart') : [];

        $cartProductsIds = array_keys($cart);
        $cartProducts = Product::whereIn('id', $cartProductsIds)->get();
        $cartSum = $cartProducts->sum(fn ($product) => $product->price * $cart[$product->id]);

        return view('cart', ['cart' => $cart, 'cartProducts' => $cartProducts, 'cartSum' => $cartSum]);
    }


    public function add(string $id)
    {
        $id = (int)$id;
        $quantity = (int)(request()->get('quantity') ?? 1);

        $session = request()->session();
        $cart = ($session->has('cart')) ? $session->get('cart') : [];

        if (!isset($cart[$id])) 
            $cart[$id] = 0;
        $cart[$id] += $quantity;

        if ($cart[$id] <= 0)
            unset($cart[$id]);

        $session->put('cart', $cart);

        return redirect()->route('index');
    }
}
