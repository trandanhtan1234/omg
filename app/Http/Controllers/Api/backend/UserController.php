<?php

namespace App\Http\Controllers\Api\backend;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepo\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\Api\AddUserAPIRequest;
use App\Http\Requests\Api\EditUserAPIRequest;
use illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $UserRepo;

    public function __construct(UserRepositoryInterface $UserRepo)
    {
        $this->UserRepo = $UserRepo;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ListUser = $this->UserRepo->ListUser();

        if ($ListUser['data'] != null) {
            return response()->json([
                'code' => $ListUser['code'],
                'msg' => $ListUser['msg'],
                'data' => $ListUser['data'],
            ], 200);
        } elseif ($ListUser['data'] == null) {
            return response()->json([
                'code' => 400,
                'msg' => $ListUser['msg'],
            ], 204);
        } else {
            return response()->json([
                'code' => $ListUser['code'],
                'msg' => $ListUser['msg'],
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddUserAPIRequest $r)
    {
        $NewUser = $this->UserRepo->AddNewUser($r);

        if ($NewUser['code'] == 200) {
            return response()->json([
                'code' => $NewUser['code'],
                'msg' => $NewUser['msg']
            ], 200);
        } elseif ($NewUser['code'] == 500) {
            return response()->json([
                'code' => $NewUser['code'],
                'msg' => $NewUser['msg']
            ], 500);
        } else {
            return response()->json([
                'code' => 400,
                'msg' => 'Page not found'
            ], 400);
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
    public function update(EditUserAPIRequest $r)
    {
        $EditUser = $this->UserRepo->EditUser($r);

        if ($EditUser['code'] == 200) {
            return response()->json([
                'code' => $EditUser['code'],
                'msg' => $EditUser['msg']
            ], 200);
        } elseif ($EditUser['code'] == 500) {
            return response()->json([
                'code' => $EditUser['code'],
                'msg' => $EditUser['msg']
            ], 500);
        } else {
            return response()->json([
                'code' => 400,
                'msg' => 'Page not found'
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
