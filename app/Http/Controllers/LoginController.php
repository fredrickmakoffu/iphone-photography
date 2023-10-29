<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\StoreRequest;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function login(StoreRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            $user = Auth::user();
            $token = $user->createToken('App Token')->plainTextToken;

            return response(['token' => $token], 200);
        }

        return response(['error' => 'Unauthorized'], 401);
    }
}
