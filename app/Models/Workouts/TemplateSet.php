<?php

declare(strict_types=1);

namespace App\Models\Workouts;

use Illuminate\Database\Eloquent\Model;

final class TemplateSet extends Model
{
    protected $fillable = [
        'template_exercise_id',
        'set_number',
        'repetitions',
        'weight',
        'order',
    ];
}
