<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Workout extends Model
{
    //

      public function items(): MorphMany
    {
        return $this->morphMany(WorkoutItem::class, 'workoutable');
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(WorkoutTemplate::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
