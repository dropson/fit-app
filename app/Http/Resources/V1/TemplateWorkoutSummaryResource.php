<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class TemplateWorkoutSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $muscleGroups = $this->exercises->pluck('title');

        $displayGroups = $muscleGroups->take(3)->implode(', ');
        $totalCount = $muscleGroups->count();

        if ($totalCount > 3) {
            $displayGroups .= ', ...';
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'duration' => $this->duration,
            'muscle_group' => $displayGroups,
        ];
    }
}
