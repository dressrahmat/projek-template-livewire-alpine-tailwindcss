<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('superadmin.user.index');
    }
}
