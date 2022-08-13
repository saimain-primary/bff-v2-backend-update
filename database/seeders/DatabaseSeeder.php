<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'name' => "SUPER_ADMIN",
            'description' => "Have access to manage the information of Admin and Client"
        ]);

        Role::create([
            'name' => "ADMIN",
            'description' => "Have access to manage the information of Client"
        ]);

        Role::create([
            'name' => "CLIENT",
            'description' => "Have access to Client Dashboard"
        ]);

        $superAdmin = User::create([
            'name' => "Super Admin",
            'email' => "super.admin@gmail.com",
            'password' => Hash::make("password"),
            'role_id' => 1
        ]);



        $admin = User::create([
            'name' => "Admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make("password"),
            'role_id' => 2
        ]);

        $client = User::create([
            'name' => "Client",
            'email' => "client@gmail.com",
            'password' => Hash::make("password"),
            'role_id' => 3
        ]);



    }
}
