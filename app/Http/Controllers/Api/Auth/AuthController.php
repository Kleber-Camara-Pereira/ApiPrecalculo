<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 

class AuthController extends Controller
{
    public function auth(Request $request){

        $user = User::where('email',$request->email)->first();

        
        if(!$user || !Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages(
                [
                    'email' => ['As credenciais estao incorretas']
                ]
                );
            
        }

        $user->tokens()->delete();

        $token = $user->createToken($request->device_name)->plainTextToken;
        
        return response()->json([
            'token' => $token
        ]);
    }
}

