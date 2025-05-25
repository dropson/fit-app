<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateExerciseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'min:5', 'max:50'],
            'instruction' => ['string', 'sometimes', 'min:10', 'max:255'],
            'equipment_group_id' => ['sometimes', 'exists:equipment_groups,id'],
            'main_muscle_group_id' => ['sometimes', 'exists:muscle_groups,id'],
            'second_muscle_group_id' => ['nullable', 'exists:muscle_groups,id'],
        ];
    }
}
