<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_user_value = [
            'email_verified_at' => now(),
            'password' => bcrypt(4444),
            'remember_token' => Str::random(10),
        ];

        DB::beginTransaction();
        try {
            Role::create(['name' => 'superadmin']);
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'ustadz']);
            Role::create(['name' => 'santri']);

            $superadmin = User::create(array_merge([
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
            ], $default_user_value));

            $superadmin->assignRole('superadmin');

            $admin = User::create(array_merge([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
            ], $default_user_value));

            $admin->assignRole('admin');

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
