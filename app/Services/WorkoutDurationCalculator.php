<?php

namespace App\Services;

class WorkoutDurationCalculator
{

    public function calculate(mixed $workout): int
    {
        $totalDuration = 0;
        $restBetweenSEts = 120;
        $exericeTransitonTime = 120;
        $setExecutionTime = 30;

        // if (!$workout->relationLoaded('templateExercises')) {
        //     $workout->load('templateExercises.sets');
        // } elseif (!$workout->exercises->first()?->relationLoaded('sets')) {
        //     $workout->load('templateExercises.sets');
        // }

        foreach ($workout->templateExercises as $index => $exercise) {
            // dd($exercise);
            $setsCount = $exercise->sets->count();

            $durationForSets = $setsCount * ($setExecutionTime + $restBetweenSEts);
            $totalDuration += $durationForSets;

            if ($index !== $workout->exercises->count() - 1) {
                $totalDuration += $exericeTransitonTime;
            }
        }

        return (int) ceil($totalDuration / 60);
    }
}
