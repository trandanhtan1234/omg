<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use illuminate\Support\Facades\Auth;
use App\Models\models\Token;

class CheckLoginAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('token');
        $tokenIsValid = Token::where('token', $token)->first();

        if ($token == '') {
            return response()->json([
                'code' => 401,
                'msg' => 'Token required'
            ], 401);
        } elseif ($tokenIsValid == '') {
            return response()->json([
                'code' => 401,
                'msg' => 'Invalid token'
            ], 401);
        } elseif ($tokenIsValid != '' && $tokenIsValid->expired_token < date('Y-m-d H:i:s')) {
            return response()->json([
                'code' => 401,
                'msg' => 'Token is expired'
            ], 401);
        } else {
            return $next($request);
        }
    }
}
