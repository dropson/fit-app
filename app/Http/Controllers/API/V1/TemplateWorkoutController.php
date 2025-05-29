<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Actions\Workouts\StoreTemplateAction;
use App\Http\Controllers\API\ApiController;
use App\Http\Requests\V1\StoreTemplateRequest;
use App\Http\Resources\V1\TemplateWorkoutResource;
use App\Http\Resources\V1\TemplateWorkoutSummaryResource;
use App\Models\Workouts\TemplateWorkout;
use App\Policies\TemplateWorkoutPolicy;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

final class TemplateWorkoutController extends ApiController
{
    protected $policyClass = TemplateWorkoutPolicy::class;

    public function index()
    {
        $user = Auth::user();
        $templates = $user->templateWorkouts()->get();

        return TemplateWorkoutSummaryResource::collection($templates);
    }

    public function store(StoreTemplateRequest $request, StoreTemplateAction $action)
    {
        try {

            $template = $action->handle($request->validated());

            return response()->json([
                'message' => 'Template workout created successfully',
                'data' => $template,
            ], 201);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show(TemplateWorkout $template): TemplateWorkoutResource|JsonResponse
    {

        if ($this->isAble('view', $template)) {
            return new TemplateWorkoutResource($template->load('templateExercises.sets', 'templateExercises.exercise'));
        }

        return $this->notAuthorized('You are not authorized to show that resource');
    }
}
