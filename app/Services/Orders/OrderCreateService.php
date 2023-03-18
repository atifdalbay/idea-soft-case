<?php

namespace App\Services\Orders;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;

class OrderCreateService
{
    public function __invoke(OrderRequest $request): Order
    {
        $data = [
            'customer_id' => $request->customer_id,
            'items' => [],
            'total' => 0,
        ];

        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);
            $data['items'][] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $product->price,
                'total' => $product->price * $item['quantity'],
            ];

            $data['total'] += $product->price * $item['quantity'];
        }

        return Order::create($data);
    }
}