<?php

declare(strict_types=1);

namespace App\Models;

use App\Filters\V1\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'instruction',
        'visibility',
        'created_by',
        'main_muscle_group_id',
        'second_muscle_group_id',
        'equipment_group_id',
    ];

    protected $casts = [
        'visibility' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(EquipmentGroup::class, 'equipment_group_id');
    }

    public function mainMuscleGroup(): BelongsTo
    {
        return $this->belongsTo(MuscleGroup::class, 'main_muscle_group_id');
    }

    public function secondMuscleGroup(): BelongsTo
    {
        return $this->belongsTo(MuscleGroup::class, 'second_muscle_group_id');
    }

    public function scopeForUserOrGlobal(Builder $query, int $userId): Builder
    {
        return $query->where(function ($q) use ($userId): void {
            $q->whereNull('created_by')
                ->orWhere('created_by', $userId);
        });
    }

    public function scopeFilter(Builder $builder, QueryFilter $filters): Builder
    {
        return $filters->apply($builder);
    }
}
