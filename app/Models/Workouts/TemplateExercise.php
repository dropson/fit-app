<?php

declare(strict_types=1);

namespace App\Models\Workouts;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Model;

final class TemplateExercise extends Model
{
    protected $fillable = [
        'template_workout_id',
        'exercise_id',
        'order',
    ];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function sets()
    {
        return $this->hasMany(TemplateSet::class);
    }
}
