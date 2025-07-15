<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class TemplateWorkoutResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        $groupedExercises = $this->items
            ->groupBy('exercise_id')
            ->map(function ($items) {
                return [
                    'id' => $items->first()->exercise->id,
                    'title' => $items->first()->exercise->title,
                    'sets' => $items->map(function ($item) {
                        return [
                            'set_number' => $item->set_number,
                            'repetitions' => $item->repetitions,
                            'weight' => $item->weight,
                        ];
                    })->values(),
                ];
            })->values();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'instruction' => $this->instruction,
            'exercises' => $groupedExercises,

        ];
    }
}
