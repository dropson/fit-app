<?php

declare(strict_types=1);

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class TemplateWorkoutSummaryResource extends JsonResource
{

    public function toArray(Request $request): array
    {

        $muscleGroupImpact = $this->items
            ->flatMap(function ($item) {
                return $item->exercise->muscleImpacts->map(function ($impact) {
                    return [
                        'group' => $impact->muscle_group,
                        'percent' => $impact->impact_percent,
                    ];
                });
            })
            ->groupBy('group')
            ->map(function ($grouped) {
                return $grouped->sum('percent');
            })
            ->sortDesc();

        $displayGroups = $muscleGroupImpact->keys()->take(3)->implode(', ');
        $totalCount = $muscleGroupImpact->count();

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
