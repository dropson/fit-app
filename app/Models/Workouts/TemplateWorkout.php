<?php

declare(strict_types=1);

namespace App\Models\Workouts;

use App\Models\Exercise;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class TemplateWorkout extends Model
{
    protected $fillable = [
        'title',
        'instruction',
        'author_id',
        'client_id',
        'duration',
        'order',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];
<<<<<<< HEAD

    public function templateExercises(): HasMany
    {
        return $this->hasMany(TemplateExercise::class);
    }

    public function exercises(): BelongsToMany
    {
        return $this->belongsToMany(Exercise::class, 'template_exercises')
            ->withPivot('id', 'order');
    }
=======
>>>>>>> c0c02ac (feat: merge template with main)
}
