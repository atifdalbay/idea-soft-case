<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ResponseBuilder;
use App\Models\Order;
use App\Services\Discounts\DiscountCalculator;
use Illuminate\Http\JsonResponse;

class DiscountController extends Controller
{
    public function calculateDiscountByOrder(Order $order, DiscountCalculator $calculator): JsonResponse
    {
        $discount = $calculator($order);
        return ResponseBuilder::success($discount);
    }
}