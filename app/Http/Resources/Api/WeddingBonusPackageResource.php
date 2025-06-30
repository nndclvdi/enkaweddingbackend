<?php

namespace App\Http\Resources\Api;

use App\Models\BonusPackage;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WeddingBonusPackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'BonusPackage' => new BonusPackageResource($this->whenLoaded('bonusPackage')),
        ];
    }
}
