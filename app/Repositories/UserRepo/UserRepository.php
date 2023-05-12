<?php

namespace App\Repositories\UserRepo;

use App\Models\models\ListUser;
use Illuminate\Support\Facades\DB;
use Exception;

class UserRepository implements UserRepositoryInterface
{
    private $ListUser;

    public function __construct(ListUser $ListUser)
    {
        $this->ListUser = $ListUser;
    }

    public function ListUser()
    {
        try {
            $GetList = DB::table('ListUser')->get();

            if ($GetList != null) {
                return [
                    'code' => 200,
                    'data' => $GetList,
                    'msg' => 'Get data Succeeded'
                ];
            } else {
                return [
                    'code' => 204,
                    'data' => '',
                    'msg' => 'No data found'
                ];
            }
        } catch (Exception $e) {
            return [
                'code' => 500,
                'data' => '',
                'msg' => 'Get data failed'
            ];
        }
    }
}
