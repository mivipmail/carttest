<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $ordersRaw = Order::with(['items'])->get();

        $orders = OrderResource::collection($ordersRaw)->resolve();
        $ordersSum = array_sum(array_column($orders, 'sum'));

        return view('orders', ['orders' => $orders, 'ordersSum' => $ordersSum]);
    }


    public function store(Request $request)
    {
        $session = $request->session();
        $cart = ($session->has('cart')) ? $session->get('cart') : [];

        $cartProductsIds = array_keys($cart);
        $cartProducts = Product::whereIn('id', $cartProductsIds)->get();

        try {
            DB::beginTransaction();

            $order = Order::create();
            
            foreach ($cart as $key=>$item) {
                $product = $cartProducts->first(fn ($product) => $product->id === $key);
                $order->items()->create([
                    'product_id' => $key,
                    'price' => $product->price,
                    'quantity' => $item,
                ]);
            }

            DB::commit();

            $session->forget('cart');
        }
        catch (Exception $e) {
            DB::rollBack();

            dd($e->getMessage());
        }

        return redirect()->route('index');
    }


    public function destroy(string $id)
    {
        $order = Order::find((int)$id);
        $order->delete();
        
        return redirect()->route('order.index');
    }
}
