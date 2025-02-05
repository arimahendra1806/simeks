<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $roles = Role::all();

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('simeks'),
            'role_id' => $roles->where('nama', 'admin')->first()->id
        ]);

        User::create([
            'name' => 'Marketing User',
            'email' => 'marketing@example.com',
            'password' => bcrypt('simeks'),
            'role_id' => $roles->where('nama', 'marketing')->first()->id
        ]);

        User::create([
            'name' => 'Direktur User',
            'email' => 'direktur@example.com',
            'password' => bcrypt('simeks'),
            'role_id' => $roles->where('nama', 'direktur')->first()->id
        ]);

        User::create([
            'name' => 'Buyer User',
            'email' => 'buyer@example.com',
            'password' => bcrypt('simeks'),
            'role_id' => $roles->where('nama', 'buyer')->first()->id
        ]);
    }
}
