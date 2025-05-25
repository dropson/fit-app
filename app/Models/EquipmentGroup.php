<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

final class EquipmentGroup extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'icon_url',
    ];
}
