<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ExerciseResource;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;

final class ExerciseController extends Controller
{
    public function index()
    {

        $userId = Auth::id();

        $exercises = Exercise::with(['equipment', 'mainMuscleGroup', 'secondMuscleGroup'])
            ->forUserOrGlobal($userId)
            ->paginate(10);


        return ExerciseResource::collection($exercises);
    }

    public function store() {}
}
