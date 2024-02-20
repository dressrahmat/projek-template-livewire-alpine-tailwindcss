<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    public function index()
    {
        return view('superadmin.permission.index');
    }
}
