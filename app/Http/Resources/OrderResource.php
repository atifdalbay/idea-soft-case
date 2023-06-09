<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer_id' => $this->customer_id,
            'items' => $this->items,
            'total' => $this->total,
            'customer' => $this->whenLoaded('customer')
        ];
    }
}
