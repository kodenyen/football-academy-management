<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Player;
use App\Models\Coach;
use Illuminate\Support\Facades\Hash;

class AcademySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@thinkright.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Coach
        $coachUser = User::create([
            'name' => 'Coach John',
            'email' => 'coach@thinkright.com',
            'password' => Hash::make('password'),
            'role' => 'coach',
        ]);

        Coach::create([
            'user_id' => $coachUser->id,
            'certification' => 'UEFA B License',
            'experience' => '10 years coaching youth football in various academies.',
            'specialization' => 'Tactical',
            'phone' => '+234 800 000 0000',
        ]);

        // Player
        $playerUser = User::create([
            'name' => 'Junior Messi',
            'email' => 'player@thinkright.com',
            'password' => Hash::make('password'),
            'role' => 'player',
        ]);

        Player::create([
            'user_id' => $playerUser->id,
            'age' => 15,
            'position' => 'Forward',
            'preferred_foot' => 'Left',
            'stats' => ['speed' => 90, 'shooting' => 85, 'dribbling' => 92],
        ]);

        // Posts
        \App\Models\Post::create([
            'title' => 'Academy Resumes Next Week',
            'slug' => 'academy-resumes',
            'content' => 'We are excited to announce that training will resume on Monday.',
            'user_id' => 1,
            'category' => 'announcement',
        ]);

        // Matches
        \App\Models\MatchFixture::create([
            'opponent' => 'Lagos City FC',
            'team_category' => 'U15',
            'match_date' => now()->addDays(5),
            'venue' => 'Main Stadium',
            'status' => 'scheduled',
        ]);
    }
}
