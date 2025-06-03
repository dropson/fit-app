<?php

namespace App\Http\Requests\V1;

use App\Enums\EquipmentEnum;
use App\Enums\MuscleGroupEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class SaveExerciseRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'title' => ['string', 'required', 'min:5', 'max:50'],
            'instruction' => ['string', 'required', 'min:10', 'max:255'],
            'equipment' => ['required', new Enum(EquipmentEnum::class)],
            'muscle_impacts' => ['required', 'array'],
            'muscle_impacts.*.muscle_group' => ['required',  new Enum(MuscleGroupEnum::class)],
            'muscle_impacts.*.impact_percent' => ['required', 'integer', 'min:1', 'max:100'],
        ];
    }
}
