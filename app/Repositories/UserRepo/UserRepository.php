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
            $GetList = DB::table('ListUser')->orderBy('id', 'DESC')->get();

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

    public function AddNewUser($params)
    {
        try {
            $NewUser = ListUser::insert([
                'email' => $params->email,
                'password' => bcrypt($params->password),
                'full' => $params->full,
                'address' => $params->address,
                'phone' => $params->phone,
                'level' => $params->level
            ]);

            return [
                'code' => 200,
                'data' => $NewUser,
                'msg' => 'Add new user succeeded'
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'data' => '',
                'msg' => 'Add new user failed'
            ];
        }
    }

    public function EditUser($params)
    {
        $getPW = ListUser::where('id', $params->id)->first();

        if ($params->password == '') {
            $password = $getPW->password;
        } else {
            $password = $params->password;
        }

        try {
            $EditUser = ListUser::where('id', $params->id)->update([
                'email' => $params->email,
                'password' => $password,
                'full' => $params->full,
                'address' => $params->address,
                'phone' => $params->phone,
                'level' => $params->level
            ]);

            return [
                'code' => 200,
                'msg' => 'Edit user succeeded'
            ];
        } catch (\Exception $e) {
            return [
                'code' => 500,
                'msg' => 'Edit user failed'
            ];
        }
    }
}
