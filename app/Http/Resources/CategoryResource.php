<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;

class CategoryResource extends JsonResource
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
            'user_id' => $this->user_id,
            'parent_id' => $this->parent_id,
            'parent' => self::make($this->whenLoaded('parent')),
            'children' => self::collection($this->whenLoaded('children')),
            'user' => UserResource::make($this->whenLoaded('user')),
        ];
    }
}
