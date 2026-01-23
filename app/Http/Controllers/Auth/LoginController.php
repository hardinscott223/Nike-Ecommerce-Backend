<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Auth\LoginResource; 
use App\Models\User;                 
use Illuminate\Support\Facades\Log;   
use Exception;

class LoginController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function login(LoginRequest $request)
    {
        try{
            $credentials = $request->validated();
            if (!$credentials) {
                return response()->json([
                    'result' => false,
                    'message' => 'Invalid email or password'
                ], 401);
            }
            $user = Auth::user();
            if ($user->status !== 'active') {
                // auth()->logout();
                return response()->json([
                    'result' => false,
                    'message' => 'Your account is suspended.'
                ], 403);
            }
            $token = $user->createToken('auth_token')->plainTextToken;   
            $user->token = $token;
            return new LoginResource($user);
        }
        catch (Exception $e){
            Log::error("Login Error: " . $e->getMessage());
            $request->session()->invalidate();
            return response()->json([
                'result' => false,
                'message' => "An error occurred during login. Please try again."
            ], 500);
        };          
    }

    /**
     * Display the specified resource.
     */
    public function logout(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
