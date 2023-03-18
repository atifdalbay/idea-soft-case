<?php

namespace App\Http\Controllers;

use App\Http\Helpers\ResponseBuilder;
use App\Http\Queries\OrderIndexQuery;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\Orders\OrderCreateService;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    public function index(OrderIndexQuery $indexQuery): JsonResponse
    {
        return ResponseBuilder::success(OrderResource::collection($indexQuery->get()));
    }

    public function store(OrderRequest $request, OrderCreateService $createService): JsonResponse
    {
        $order = $createService($request);

        return ResponseBuilder::success(
            new OrderResource($order),
            __('api.app.common.responses.resource_created', ['resource' => 'Order'])
        );
    }

    public function destroy(Order $order): JsonResponse
    {
        $order->delete();

        return ResponseBuilder::success(__('api.app.common.responses.resource_deleted', ['resource' => 'Order']));
    }

}