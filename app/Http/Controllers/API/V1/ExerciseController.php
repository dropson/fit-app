<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Actions\Exercise\SaveExerciseAction;
use App\Actions\Exercise\StoreExerciseAction;
use App\DTOs\ExerciseDTO;
use App\Filters\V1\ExerciseFilter;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\V1\SaveExerciseRequest;
use App\Http\Requests\V1\StoreExerciseRequest;
use App\Http\Requests\V1\UpdateExerciseRequest;
use App\Http\Resources\V1\ExerciseResource;
use App\Models\Exercise;
use App\Policies\ExercisePolicy;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

final class ExerciseController extends ApiController
{
    protected $policyClass = ExercisePolicy::class;

    public function index(ExerciseFilter $filters)
    {

        $userId = Auth::id();

        $exercises = Exercise::with(['muscleImpacts'])
            ->forUserOrGlobal($userId)
            ->filter($filters)
            ->get();

        return ExerciseResource::collection($exercises);
    }

    public function store(SaveExerciseRequest $request, SaveExerciseAction $action): JsonResponse
    {

        $action->handle(ExerciseDTO::fromRequest($request));

        return $this->ok('Exercise created successfully.');
    }

    public function show(Exercise $exercise): ExerciseResource
    {
        return new ExerciseResource($exercise);
    }

    public function update(SaveExerciseRequest $request, Exercise $exercise, SaveExerciseAction $action): JsonResponse
    {
        if ($this->isAble('update', $exercise)) {
            $action->handle(ExerciseDTO::fromRequest($request), $exercise);
            return $this->ok('Exercise successfully updated');
        }
        return $this->notAuthorized('You are not authorized to update that resource');
    }

    public function destroy(Exercise $exercise): JsonResponse
    {
        if ($this->isAble('delete', $exercise)) {

            $exercise->delete();

            return $this->ok('Exercise successfully deleted');
        }

        return $this->notAuthorized('You are not authorized to delete that resource');
    }
}
