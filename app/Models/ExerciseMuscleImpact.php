<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\MuscleGroupEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class ExerciseMuscleImpact extends Model
{
    protected $fillable = [
        'exercise_id',
        'muscle_group',
        'impact_percent',
    ];

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }

    public function getMuscleGroupLabelAttribute(): string
{
    return MuscleGroupEnum::from($this->muscle_group)->label();
}
}
