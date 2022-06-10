<?php

namespace App\Actions;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class RegisterAction
{
    public static function handle(RegisterRequest $request)
    {
        return DB::transaction(function () use ($request) {
            $credentials = Arr::except($request->getData(), 'encrypted_password');

            $user = User::create($credentials);

            return $user;
        });
    }
}
