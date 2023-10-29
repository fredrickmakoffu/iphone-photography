<?php

namespace App\Http\Controllers;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Http\Requests\Comment\StoreRequest;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    const ACHIEVEMENT_TYPE = 'comment';

    public function store(StoreRequest $request): JsonResponse
    {
        // create comment
        $comment = $request->user()->comments()->create($request->validated());

        // dispatch AchievementUnlocked event
        AchievementUnlocked::dispatch($request->user(), self::ACHIEVEMENT_TYPE);

        // set badge if any
        BadgeUnlocked::dispatch($request->user());

        // return response
        return response()->json($comment, 201);
    }
}
