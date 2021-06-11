<?php

namespace App\Http\Resources\Product;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'price' => number_format($this->price, 2),
            'quantity' => $this->quantity,
            'created_at' => Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y H:i:s'),
        ];
    }
}
