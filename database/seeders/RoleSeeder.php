<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'ADMINISTRATOR', 'slug' => 'administrator'],
            ['name' => 'BUYER', 'slug' => 'buyer'],
            ['name' => 'SELLER', 'slug' => 'seller'],
            ['name' => 'AGENT', 'slug' => 'agent'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
