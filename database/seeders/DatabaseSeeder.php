<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //call the seeder classes in their correct order of dependency
        $this->call(RoleSeeder::class);

        User::factory()->create([
            'name' => 'Jim',
            'email' => 'jim@gmail.com',
            'password' => 'field182',
            'is_active' => 1,
            'role_id' => 1
         ]);

    }
}
