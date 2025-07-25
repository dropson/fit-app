<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserGenderEnum;
use App\Models\Workouts\TemplateWorkout;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

final class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    private string $guard_name = 'api';

    public function exercises(): HasMany
    {
        return $this->hasMany(Exercise::class, 'created_by');
    }

    public function workoutTemplates()
    {
        return $this->hasMany(WorkoutTemplate::class, 'author_id');
    }
   public function getFullNameAttribute()
    {
    	return ucwords("{$this->first_name} {$this->last_name}");
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'gender' => UserGenderEnum::class,
        ];
    }
}
