<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccController extends Controller
{
    public function Index()
    {
        return view('backend.acc.listuser');
    }
}
