<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['role_name' => 'admin'],
            ['role_name' => 'pelayanan'],
            ['role_name' => 'dukuh'],
            ['role_name' => 'warga'],
            ['role_name' => 'aparatur'],
            ['role_name' => 'bpkal'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}