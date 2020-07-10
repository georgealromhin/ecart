<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;
use App\Http\Resources\OrderDetailsResourceCollection;


class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_number' => $this->order_number,
            'comments' => $this->comments,
            'delivery_address' => $this->delivery_address,
            'order_type' => $this->order_type,
            'order_status' => $this->order_status,
            'created_at' => Carbon::parse($this->created_at)->format('d M Y H:i'),
            'total' => $this->total,
            'customer' => $this->customer->only('id', 'name', 'email', 'phone'),
            'order_details' => new OrderDetailsResourceCollection($this->order_details),
        ];
    }
}
