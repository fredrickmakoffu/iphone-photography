<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Comment\StoreRequest;
use App\Services\Achievements\LogUserAchievementsService;
use App\Services\Badges\SetUserBadgeService;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    const ACHIEVEMENT_TYPE = 'comment';

    public function store(StoreRequest $request, LogUserAchievementsService $logAchievement, SetUserBadgeService $setBadge): JsonResponse
    {
        // create comment
        $comment = $request->user()->comments()->create($request->validated());

        // create achievements if any 
        $logAchievement->execute();

        // set badge if any
        $setBadge->execute();

        // return response
        return response()->json($comment, 201);
    }
}
