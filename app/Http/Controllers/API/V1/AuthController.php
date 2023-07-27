<?php

namespace App\Http\Controllers\API\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    use HttpResponses;
    
    public function register(StoreUserRequest $request) {
        try {
            // $user = User::create($request->validated());
            // return $this->success([
            //     'user' => $user,
            //     'token' => $user->createToken("API TOKEN")->plainTextToken
            // ]);

            $request->validated($request->all());
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return $this->success([
                'user' => $user,
                'token' => $user->createToken('my-token-name')->plainTextToken
            ]);
        }
        catch (Exception $ex) {
            // return response()->json([
            //     'status' => false,
            //     'message' => $ex->getMessage()
            // ], 500);

            return $this->error('', $ex->getMessage(), 500);
        }
    }

    public function login(LoginUserRequest $request) {
        try {
            $request->validated();
            $user = User::where('email', request('email'))->first();

            if (Hash::check(request('password'), $user->getAuthPassword())) {
                // return $this->success([
                //     'user' => $user,
                //     'token' => $user->createToken('my-token-name')->plainTextToken
                // ]);

                return $this->success([
                    'user' => $user,
                    'token' => $user->tokens->isEmpty() ? $user->createToken('my-token-name')->plainTextToken : $user->tokens->first()->plainTextToken
                ]);
            }

            return $this->error('', 'Email and Passwword is incorrect!', 404);
        }
        catch (Exception $ex) {
            // return response()->json([
            //     'status' => false,
            //     'message' => $ex->getMessage()
            // ], 500);

            return $this->error('', $ex->getMessage(), 500);
        }
    }

    public function logout() {
        Auth::user()->currentAccessToken()->delete();
        return $this->success([
            'message' => 'You have succesfully been logged out and your token has been removed'
        ]);
    }
}
