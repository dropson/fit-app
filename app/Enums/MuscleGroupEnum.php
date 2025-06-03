<?php

declare(strict_types=1);

namespace App\Enums;

enum MuscleGroupEnum: string
{
    case Abs = 'Abs';
    case Biceps = 'Biceps';
    case Calves = 'Calves';
    case Chest = 'Chest';
    case Forearms = 'Forearms';
    case Glutes = 'Glutes';
    case Hamstrings = 'Hamstrings';
    case Lowerback = 'Lowerback';
    case Middleback = 'Middleback';
    case Quadriceps = 'Quadriceps';
    case Shoulders = 'Shoulders';
    case Triceps = 'Triceps';
    case Upperback = 'Upperback';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::Abs => 'Abs',
            self::Biceps => 'Biceps',
            self::Calves => 'Calves',
            self::Chest => 'Chest',
            self::Forearms => 'Forarms',
            self::Glutes => 'Glutes',
            self::Hamstrings => 'Hamstrings',
            self::Lowerback => 'Lower Back',
            self::Middleback => 'Middle Back',
            self::Quadriceps => 'Quadriceps',
            self::Shoulders => 'Shoulders',
            self::Triceps => 'Triceps',
            self::Upperback => 'Upper Back',
        };
    }
}
