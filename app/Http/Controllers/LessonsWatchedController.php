<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lesson\StoreRequest;
use App\Services\Achievements\LogUserAchievementsService;
use App\Services\Badges\SetUserBadgeService;
use Illuminate\Http\JsonResponse;
use App\Models\LessonsWatched;

class LessonsWatchedController extends Controller
{
    const ACHIEVEMENT_TYPE = 'lesson';
    private LessonsWatched $lessonsWatched;

    public function __construct()
    {
        $this->lessonsWatched = new LessonsWatched();
    }

    public function store(StoreRequest $request, LogUserAchievementsService $logAchievement, SetUserBadgeService $setBadge): JsonResponse
    {
        // create comment
        $comment = $this->lessonsWatched->create($request->validated());

        // create achievements if any 
        $logAchievement->execute(self::ACHIEVEMENT_TYPE);

        // set badge if any
        $setBadge->execute();

        // return response
        return response()->json($comment, 201);
    }
}
