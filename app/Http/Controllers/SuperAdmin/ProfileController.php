<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit(User $user)
    {
        return view('superadmin.profile.edit', compact('user'));
    }
}
