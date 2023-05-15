<?php

namespace App\Http\Controllers\Api\backend;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepo\UserRepositoryInterface;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        //
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
