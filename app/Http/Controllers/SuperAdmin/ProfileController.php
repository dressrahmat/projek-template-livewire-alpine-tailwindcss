<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Models\User;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function edit(User $user)
    {
        return view('superadmin.profile.edit', compact('user'));
    }
}
