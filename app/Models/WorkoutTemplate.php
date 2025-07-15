<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkoutTemplate extends Model
{
    use HasFactory;
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

    public function items()
    {
        return $this->morphMany(WorkoutItem::class, 'workoutable')->orderBy('order');
    }
    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function client(): BelongsTo
    {
        return $this->belongsTo(User::class, 'client_id');
    }
}
