<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            RolesTableSeeder::class,
            GendersTableSeeder::class,
        ]);

        User::create([
            'firstname' => 'Admin',
            'lastname' => 'One',
            'email' => 'admin.one@safeplate.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'gender_id' => 1,
        ]);
    }
}
