<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class TemplateExerciseResource extends JsonResource
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
            'exercise_id' => $this->exercise_id,
            'exercise_name' => $this->exercise->title,
            'order' => $this->order,
            'sets' => TemplateSetResource::collection($this->whenLoaded('sets')),
        ];
    }
}
