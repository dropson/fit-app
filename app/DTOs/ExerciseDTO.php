<?php

namespace App\DTOs;

use App\Enums\EquipmentEnum;
use App\Enums\MuscleGroupEnum;
use App\Http\Requests\V1\SaveExerciseRequest;

class ExerciseDTO
{
    public function __construct(
        public string $title,
        public string $instruction,
        public EquipmentEnum $equipment,
        public array $muscleImpacts,
    ) {}


    public static function fromRequest(SaveExerciseRequest $request): self
    {
        return new self(
            title: $request->input('title'),
            instruction: $request->input('instruction'),
            equipment: EquipmentEnum::from($request->input('equipment')),
            muscleImpacts: collect($request->input('muscle_impacts', []))
                ->map(fn($item) => [
                    'muscle_group' => MuscleGroupEnum::from($item['muscle_group']),
                    'impact_percent' => (int) $item['impact_percent'],
                ])->toArray(),
        );
    }
}
