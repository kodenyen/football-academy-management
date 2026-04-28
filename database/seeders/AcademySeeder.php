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
        User::updateOrCreate(['email' => 'admin@thinkright.com'], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Coach
        $coachUser = User::updateOrCreate(['email' => 'coach@thinkright.com'], [
            'name' => 'Coach John',
            'password' => Hash::make('password'),
            'role' => 'coach',
        ]);

        Coach::updateOrCreate(['user_id' => $coachUser->id], [
            'certification' => 'UEFA B License',
            'experience' => '10 years coaching youth football in various academies.',
            'specialization' => 'Tactical',
            'phone' => '+234 800 000 0000',
        ]);

        User::updateOrCreate(['email' => 'manager@thinkright.com'], [
            'name' => 'Manager Mike',
            'password' => Hash::make('password'),
            'role' => 'website_manager',
        ]);

        // Player
        $playerUser = User::updateOrCreate(['email' => 'player@thinkright.com'], [
            'name' => 'Junior Messi',
            'password' => Hash::make('password'),
            'role' => 'player',
        ]);

        Player::updateOrCreate(['user_id' => $playerUser->id], [
            'age' => 15,
            'position' => 'Forward',
            'preferred_foot' => 'Left',
            'stats' => ['speed' => 90, 'shooting' => 85, 'dribbling' => 92],
        ]);

        // Posts
        \App\Models\Post::firstOrCreate(['slug' => 'academy-resumes'], [
            'title' => 'Academy Resumes Next Week',
            'content' => 'We are excited to announce that training will resume on Monday.',
            'user_id' => 1,
            'category' => 'announcement',
        ]);

        // Site Settings
        \App\Models\SiteSetting::firstOrCreate(['id' => 1], [
            'academy_name' => 'THINK RIGHT FOOTBALL ACADEMY',
            'primary_color' => '#00FF41',
            'secondary_color' => '#000000',
            'background_color' => '#18181b',
            'phone_number' => '+234 800 000 0000',
            'email' => 'info@thinkrightacademy.com',
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
            \App\Models\AcademyProgram::firstOrCreate(['name' => $prog['name']], $prog);
        }

        // Default Facilities
        $facilities = [
            ['name' => 'Main Training Pitch', 'description' => 'Professional-grade hybrid grass pitch designed for elite performance.', 'order' => 1],
            ['name' => 'Elite Fitness Gym', 'description' => 'Fully equipped modern gym for strength and conditioning.', 'order' => 2],
            ['name' => 'Recovery Center', 'description' => 'Specialized area for physio and player recovery.', 'order' => 3],
        ];

        foreach ($facilities as $fac) {
            \App\Models\Facility::firstOrCreate(['name' => $fac['name']], $fac);
        }

        // Matches
        \App\Models\MatchFixture::firstOrCreate(['opponent' => 'Lagos City FC', 'team_category' => 'U15'], [
            'match_date' => now()->addDays(5),
            'venue' => 'Main Stadium',
            'status' => 'scheduled',
        ]);
    }
}
