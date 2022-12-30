<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    public function index()
    {
        $cachedUser = Redis::get('users');

        if (isset($cachedUser)) {
            $user = json_decode($cachedUser, FALSE);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from redis',
                'data' => $user,
            ]);
        } else {
            $user = User::all();
            Redis::set('users', $user, 'EX', 10 * 60);

            return response()->json([
                'status_code' => 201,
                'message' => 'Fetched from database',
                'data' => $user,
            ]);
        }
    }
}
