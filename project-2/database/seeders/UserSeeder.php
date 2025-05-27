<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'user1', 'email' => 'user1@gmail.com'],
            ['name' => 'user2', 'email' => 'user2@gmail.com'],
            ['name' => 'user3', 'email' => 'user3@gmail.com'],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password123'),
            ]);

            Client::factory()->count(rand(0, 10))->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
