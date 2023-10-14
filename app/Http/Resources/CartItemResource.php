<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
            'number' => $this->number,
            'product' => ProductResource::make($this->whenLoaded('product')),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
