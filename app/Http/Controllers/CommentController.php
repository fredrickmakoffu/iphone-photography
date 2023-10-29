<?php

namespace App\Http\Controllers;

use App\Events\AchievementUnlocked;
use App\Events\BadgeUnlocked;
use App\Http\Requests\Comment\StoreRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\Helpers\ApiResponse;

class CommentController extends Controller
{
    use ApiResponse;
    const ACHIEVEMENT_TYPE = 'comment';

    public function store(StoreRequest $request): JsonResponse
    {
        // create comment
        $comment = $request->user()->comments()->create(array_merge($request->validated(), [
            'user_id' => $request->user()->id
        ]));

        // dispatch AchievementUnlocked event
        AchievementUnlocked::dispatch($request->user(), self::ACHIEVEMENT_TYPE);

        // set badge if any
        BadgeUnlocked::dispatch($request->user());

        // return response
        return $this->success($comment);
    }
}
