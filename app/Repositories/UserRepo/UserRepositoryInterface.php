<?php

namespace App\Repositories\UserRepo;

interface UserRepositoryInterface
{
    public function ListUser();

    public function AddNewUser($params);

    public function EditUser($params);
}
