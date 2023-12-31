<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lesson\StoreRequest;
use Illuminate\Http\JsonResponse;
use App\Models\LessonsWatched;
use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Traits\Helpers\ApiResponse;

class LessonsWatchedController extends Controller
{
    use ApiResponse;
    const ACHIEVEMENT_TYPE = 'lesson';
    private LessonsWatched $lessonsWatched;

    public function __construct()
    {
        $this->lessonsWatched = new LessonsWatched();
    }

    public function store(StoreRequest $request): JsonResponse
    {
        // create comment
        $lesson = $this->lessonsWatched->create(array_merge($request->validated(), ['user_id' => $request->user()->id]));

        // dispatch AchievementUnlocked event
        AchievementUnlocked::dispatch($request->user(), self::ACHIEVEMENT_TYPE);

        // set badge if any
        BadgeUnlocked::dispatch($request->user());

        // return response
        return $this->success($lesson);
    }
}
