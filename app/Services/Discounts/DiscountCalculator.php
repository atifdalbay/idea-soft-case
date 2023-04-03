<?php

namespace App\Services\Discounts;

use App\Models\Order;
use App\Models\Product;

class DiscountCalculator
{
    public function __invoke(Order $order): array
    {
        $totalPrice = $order->total;
        $discounts = [];
        $productPrices = [];
        $totalDiscount = 0;
        $productCount = 0;
        $discountStatus = false;

        foreach ($order->items as $item) {

            $product = Product::find($item['product_id']);

            if ($totalPrice >= 1000) {
                $discountAmount = ($totalPrice / 100) * 10;
                $totalPrice = $totalPrice - $discountAmount;

                $discounts[] = [
                    'discount_reason' => '10_PERCENT_OVER_1000',
                    'discount_amount' => number_format($discountAmount,2),
                    'sub_total' => number_format($totalPrice,2),
                ];

                $totalDiscount += $discountAmount;
            }

            if ($product->category == 2 && $item['quantity'] >= 6) {
                $discountAmount = $item['unit_price'];
                $totalPrice = $totalPrice - $discountAmount;

                $discounts[] = [
                    'discount_reason' => 'BUY_5_GET_1',
                    'discount_amount' => number_format($discountAmount,2),
                    'sub_total' => number_format($totalPrice,2),
                ];

                $totalDiscount += $discountAmount;

            } else if ($product->category == 1) {
                $productCount++;

                $productPrices[] = $product->price;

                if ($productCount >= 2) {
                    $minPrice = min($productPrices);
                    $discountAmount = ($minPrice / 100) * 20;
                    $totalPrice = $totalPrice - $discountAmount;

                    if (! $discountStatus) {
                        $discountStatus = true;

                        $discounts[] = [
                            'discount_reason' => '20_PERCENT_CAT_1_MİN_PRODUCT',
                            'discount_amount' => number_format($discountAmount,2),
                            'sub_total' => number_format($totalPrice,2),
                        ];

                        $totalDiscount += $discountAmount;

                    }
                }

            }
        }

        return [
            'order_id' => $order->id,
            'discounts' => $discounts,
            'total_discount' => number_format($totalDiscount,2),
            'discounted_total' => number_format($order->total - $totalDiscount,2),
        ];

    }
}