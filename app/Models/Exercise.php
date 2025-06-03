<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\EquipmentEnum;
use App\Filters\V1\QueryFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'instruction',
        'visibility',
        'created_by',
        'equipment',
    ];

    protected $casts = [
        'visibility' => 'boolean',
        'equipment' => EquipmentEnum::class,
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function muscleImpacts(): HasMany
    {
        return $this->hasMany(ExerciseMuscleImpact::class);
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
