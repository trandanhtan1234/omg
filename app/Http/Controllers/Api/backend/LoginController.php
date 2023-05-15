<?php

namespace App\Http\Controllers\Api\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AddUserAPIRequest;
use illuminate\Support\Facades\Auth;
use App\Models\models\Token;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUserAPIRequest $request)
    {
        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $checkTokenExists = Token::where('user_id', Auth::id())->first();

            if (empty($checkTokenExists)) {
                $UserToken = Token::create([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'expired_token' => date('Y-m-d H:i:s', strtotime('+30 minutes')),
                    'user_id' => Auth::id()
                ]);
            } elseif (!empty($checkTokenExists) && $checkTokenExists->expired_token < date('Y-m-d H:i:s')) {
                $UpdateToken = Token::where('user_id', Auth::id())->update([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'expired_token' => date('Y-m-d H:i:s', strtotime('+30 minutes')),
                ]);

                $UserToken = $checkTokenExists;
            } else {
                $UserToken = $checkTokenExists;
            }

            return response()->json([
                'code' => 200,
                'data' => $UserToken
            ], 200);
        } else {
            return response()->json([
                'code' => 401,
                'msg' => 'Email or password is incorrect'
            ], 401);
        }
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
