<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Actions\RegisterAction;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AuthJsonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['signup', 'signin']]);
    }

    public function users(Request $request): AnonymousResourceCollection
    {
        return UserResource::collection(
            User::query()->paginate($request->query('perPage', 10))
        );
    }

    public function signup(RegisterRequest $request)
    {
        try {
            $user = RegisterAction::handle($request);

            $token = Auth::guard('api')->login($user);

            return $this->respondWithToken($user, $token);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => $th->getCode(),
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function signin(LoginRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        return $this->respondWithToken(Auth::guard('api')->user(), $token);
    }

    protected function respondWithToken($user, $token)
    {
        return response()->json([
            'email' => $user->email,
            'token' => $token,
            'username' => $user->username,
        ]);
    }
}
