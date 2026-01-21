<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function login(LoginRequest $request)
    {
        try{
            $credentials = $request->validated();
            if (!auth()->attempt($credentials)) {
                return response()->json([
                    'result' => false,
                    'message' => 'Invalid email or password'
                ], 401);
            }
            $user = auth()->user();
            if ($user->status !== 'active') {
                auth()->logout();
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
    public function show(string $id)
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
