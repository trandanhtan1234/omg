<?php

namespace App\Models\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListUser extends Model
{
    use HasFactory;

    protected $table = 'listuser';

    protected $primaryKey = 'id';

    protected $hidden = ['password'];

    public $timestamps = false;
}
