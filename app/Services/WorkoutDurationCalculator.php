<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class WorkoutDurationCalculator
{
    public function calculate(Model $workout): int
    {
        $totalDuration = 0;
        $restBetweenSets = 120;
        $exerciseTransitionTime = 120;
        $setExecutionTime = 30;

        if (!$workout->relationLoaded('items')) {
            $workout->load('items');
        }

        $grouped = $workout->items->groupBy('exercise_id');
        $exerciseIndex = 0;
        foreach ($grouped as $exerciseId => $items) {
            $setsCount = $items->count();

            $durationForSets = $setsCount * ($setExecutionTime + $restBetweenSets);
            $totalDuration += $durationForSets;

            if (++$exerciseIndex !== $grouped->count()) {
                $totalDuration += $exerciseTransitionTime;
            }
        }

        return (int) ceil($totalDuration / 60);
    }
}
