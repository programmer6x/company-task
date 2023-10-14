<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'full_name' => $this->full_name,
            'avatar' => $this->avatar,
            'national_code' => $this->national_code,
            'email' => $this->email,
            'categories' => CategoryResource::collection($this->whenLoaded('categories')),
        ];
    }
}
