<?php

namespace App\Http\Queries;

use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class OrderIndexQuery extends QueryBuilder
{
    public function __construct(Request $request)
    {
        $query = Order::query();

        parent::__construct($query, $request);

        $this
            ->allowedIncludes(['customer'])
            ->allowedFilters(['customer_id']);
    }
}