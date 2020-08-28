<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    
    public function authenticate(Request $request)
    {
        // Credenciales
        $credentials = $request->only('email', 'password');

        try {
            
            // Verificar credenciales
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'credenciales invalidas'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'ocurrio un error al crear el token'], 500);
        }

        return response()->json(compact('token'));
    }


    public function getAuthenticatedUser(Request $request)
    {

        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                    return response()->json(['user_not_found'], 404);
            }
            } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                    return response()->json(['token_expired'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                    return response()->json(['token_invalid'], $e->getStatusCode());
            } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                    return response()->json(['token_absent'], $e->getStatusCode());
            }
            return response()->json(compact('user'));
    }
}
