<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Coach;
use App\Models\Player;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Account
        User::updateOrCreate(
            ['email' => 'admin@trfa.com'],
            [
                'name' => 'Academy Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // 2. Coach Account
        $coachUser = User::updateOrCreate(
            ['email' => 'coach@trfa.com'],
            [
                'name' => 'Coach Marcus',
                'password' => Hash::make('password'),
                'role' => 'coach',
            ]
        );

        Coach::updateOrCreate(
            ['user_id' => $coachUser->id],
            [
                'certification' => 'UEFA Pro License',
                'experience' => '10 Years',
                'specialization' => 'Tactical Development',
                'phone' => '+234 800 000 0001',
            ]
        );

        // 3. Player (Student) Account
        $playerUser = User::updateOrCreate(
            ['email' => 'player@trfa.com'],
            [
                'name' => 'Demo Student',
                'password' => Hash::make('password'),
                'role' => 'player',
            ]
        );

        Player::updateOrCreate(
            ['user_id' => $playerUser->id],
            [
                'age' => 16,
                'position' => 'Midfielder',
                'preferred_foot' => 'Right',
                'height' => 175,
                'weight' => 68,
                'stats' => [
                    'speed' => 85,
                    'dribbling' => 78,
                    'shooting' => 72,
                    'passing' => 88
                ],
                'bio' => 'Aspiring professional midfielder with excellent vision and ball control.'
            ]
        );
    }
}
