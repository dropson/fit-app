<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class ExerciseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'instruction' => $this->instruction,
            'equipment' => [
                'id' => $this->equipment->id,
                'title' => $this->equipment->title,
            ],
            'main_muscle_group' => $this->mainMuscleGroup ? [
                'id' => $this->mainMuscleGroup->id,
                'title' => $this->mainMuscleGroup->title,
            ] : null,
            'second_muscle_group' => $this->secondaryMuscleGroup ? [
                'id' => $this->secondMuscleGroup->id,
                'title' => $this->secondMuscleGroup->title,
            ] : null,
            'created_by' => $this->created_by,
        ];
    }
}
