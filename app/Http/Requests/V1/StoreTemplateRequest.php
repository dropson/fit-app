<?php

declare(strict_types=1);

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

final class StoreTemplateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string',  'string', 'min:5', 'max:100'],
            'instruction' => ['required', 'string', 'min:5', 'max:500'],
            'order' => ['required', 'integer'],
            'exercises' => ['required', 'array'],
            'exercises.*.exercise_id' => ['required', 'exists:exercises,id'],
            'exercises.*.order' => ['nullable', 'integer'],
            'exercises.*.sets' => ['required', 'array'],
            'exercises.*.sets.*.set_number' => ['required', 'integer'],
            'exercises.*.sets.*.repetitions' => ['required', 'integer'],
            'exercises.*.sets.*.weight' => ['required', 'numeric'],
        ];
    }
}
