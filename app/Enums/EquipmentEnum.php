<?php

declare(strict_types=1);

namespace App\Enums;

enum EquipmentEnum: string
{
    case None = 'None';
    case Barbell = 'Barbell';
    case Dumbbells = 'Dumbbells';
    case Kettlebell = 'Kettlebell';
    case Machine = 'Machine';
    case Bosuball = 'Bosuball';
    case Cablestation = 'Cablestation';
    case Resistancebands = 'Resistancebands';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return match ($this) {
            self::None => 'None',
            self::Barbell => 'Barbell',
            self::Dumbbells => 'Dumbbells',
            self::Kettlebell => 'Kettlebell',
            self::Machine => 'Machine',
            self::Bosuball => 'Bosu Ball',
            self::Cablestation => 'Cable Station',
            self::Resistancebands => 'Resistance Bands',
        };
    }
}
