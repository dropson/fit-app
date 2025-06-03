<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class ExerciseResource extends JsonResource
{
    public function toArray(Request $request): array
    {

        $muscleImpacts = $this->muscleImpacts->sortByDesc('impact_percent')->values();
        $primary = $muscleImpacts->first();
        $secondary = $muscleImpacts->slice(1);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'instruction' => $this->instruction,
            'equipment' => $this->equipment->label(),
            'primary_muscle_group' =>  $primary->muscle_group_label,
            'secondary_muscle_groups' => $secondary->map(fn($item) => (
                $item->muscle_group_label
            ))->values(),
            'created_by' => $this->created_by,
        ];
    }
}
