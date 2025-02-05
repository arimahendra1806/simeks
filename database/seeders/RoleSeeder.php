<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = ['admin', 'marketing', 'direktur', 'buyer'];

        foreach ($roles as $role) {
            Role::create([
                'nama' => $role
            ]);
        }
    }
}
