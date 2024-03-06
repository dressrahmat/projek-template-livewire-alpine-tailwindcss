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
            Role::create(['name' => 'admin']);
            Role::create(['name' => 'penulis']);
            Role::create(['name' => 'pembaca']);

            $penulis = User::create(array_merge([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
            ], $default_user_value));

            $penulis->assignRole('admin');

            $penulis = User::create(array_merge([
                'name' => 'dedy',
                'email' => 'dedy@gmail.com',
            ], $default_user_value));

            $penulis->assignRole('penulis');

            $pembaca = User::factory()->count(350)->create()->each(function ($user) {
                $user->assignRole('pembaca');
            });

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
