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
        $likeStr = '%'.$value.'%';

        return $this->builder->where('title', 'like', $likeStr);
    }

    public function equipment($id)
    {
        return $this->builder->where('equipment_group_id', $id);
    }

    public function muscleGroup($id)
    {
        return $this->builder->where('main_muscle_group_id', $id);
    }
}
