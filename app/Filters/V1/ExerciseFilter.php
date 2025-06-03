<?php

declare(strict_types=1);

namespace App\Filters\V1;

final class ExerciseFilter extends QueryFilter
{
    protected $sortable = [
        'title',
        'equipment',
        'muscleGroup',
    ];

    public function title(string $value)
    {
        $likeStr = '%' . $value . '%';

        return $this->builder->where('title', 'like', $likeStr);
    }

    public function equipment($value)
    {
        return $this->builder->where('equipment', $value);
    }

    public function muscleGroup(string | array $groups)
    {
        $groups = (array) $groups;

        return $this->builder->whereHas('muscleImpacts', function ($query) use ($groups) {
            $query->whereIn('muscle_group', $groups);
        })
            ->whereHas('muscleImpacts', function ($query) use ($groups) {
                $query->whereRaw("
            impact_percent = (
                SELECT MAX(impact_percent)
                FROM exercise_muscle_impacts AS mi
                WHERE mi.exercise_id = exercise_muscle_impacts.exercise_id
            )
        ")->whereIn('muscle_group', $groups);
            });
    }
}
