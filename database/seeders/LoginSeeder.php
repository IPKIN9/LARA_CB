<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
Use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginSeeder extends Seeder
{
    
    public function run()
    {
        $data = array(
            'name' => 'Super Admin',
            'username' => 'request_superadmin',
            'password' => Hash::make('request_pass'),
            'role' => 'super_admin'
        );
        $admin = User::create($data);
        $admin->assignRole('super_admin');
    }
}
