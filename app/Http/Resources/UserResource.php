<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'your name'=>$this->name,
            'your email'=>$this->email,
            'Date'=>$this->created_at->format('Y-m-d'),
            'Profile info'=>new ProfileResource($this->whenLoaded('profile'))
        ];
    }
}
