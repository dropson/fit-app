<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class TemplateSetResource extends JsonResource
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
            'set_number' => $this->set_number,
            'repetitions' => $this->repetitios,
            'weight' => $this->weight,
            'order' => $this->order,
        ];
    }
}
