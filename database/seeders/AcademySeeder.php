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

        User::create([
            'name' => 'Manager Mike',
            'email' => 'manager@thinkright.com',
            'password' => Hash::make('password'),
            'role' => 'website_manager',
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

        // Site Settings
        \App\Models\SiteSetting::updateOrCreate(['id' => 1], [
            'academy_name' => 'THINK RIGHT FOOTBALL ACADEMY',
            'primary_color' => '#00FF41',
            'secondary_color' => '#000000',
            'phone_number' => '+234 800 000 0000',
            'email' => 'info@thinkright academy.com',
            'address' => 'Lagos, Nigeria',
            'about_us_content' => 'Empowering the next generation of football stars through professional coaching and disciplined training.',
            'footer_text' => '© THINK RIGHT FOOTBALL ACADEMY. All Rights Reserved.',
        ]);

        // Default Programs
        $programs = [
            ['name' => 'U10 Category', 'description' => 'Foundation stage focusing on ball control and fun.', 'order' => 1],
            ['name' => 'U13 Category', 'description' => 'Development stage focusing on tactical awareness.', 'order' => 2],
            ['name' => 'U17 Category', 'description' => 'Professional pathway focusing on physical and mental strength.', 'order' => 3],
        ];

        foreach ($programs as $prog) {
            \App\Models\AcademyProgram::updateOrCreate(['name' => $prog['name']], $prog);
        }

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
