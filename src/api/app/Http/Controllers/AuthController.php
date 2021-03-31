<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        abort_unless(
            auth()->attempt(
                $request->validated(),
                $request->has('remember')
            ),
            response([
                'message' => ['Unauthorized.']
            ], 401)
        );

        /**
         * Generate API token for access from third parties.
         * TODO: Identify third-party devices if possible.
         */
        // $token = auth()
        //     ->user()
        //     ->createToken('api')
        //     ->plainTextToken;

        return response(auth()->guard('web')->user(), 200);
    }

    public function logout(Request $request)
    {
        /**
         * Middlewareで `api:sanctum` を利用した場合に `auth()->logout` でログアウトできない
         * - https://github.com/laravel/sanctum/issues/87#issuecomment-691660791
         */
        try {
            auth()->guard('web')->logout();
        } catch (\Exception $e) {
            abort(response(['message' => $e->getMessage()], 500));
        }

        return response(null, 204);
    }

    public function loggedin(Request $request)
    {
        return response(auth()->guard('web')->user(), 200);
    }
}
