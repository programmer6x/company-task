<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'price' => $this->price,
            'sold_number' => $this->price,
            'frozen_number' => $this->price,
            'marketable_number' => $this->price,
            'user_id' => $this->user_id,
            'category_id' => $this->category_id,
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
