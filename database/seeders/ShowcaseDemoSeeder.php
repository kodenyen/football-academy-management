<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ShowcaseVideo;
use App\Models\Player;

class ShowcaseDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Find our Demo Student
        $player = Player::whereHas('user', function($q) {
            $q->where('email', 'player@trfa.com');
        })->first();

        // 1. Linked Highlight (Hybrid) - Using a skills/training video that allows embedding
        ShowcaseVideo::updateOrCreate(
            ['youtube_url' => 'https://www.youtube.com/watch?v=aqidX7_8Irw'],
            [
                'player_id' => $player?->id,
                'title' => 'Demo Student - Technical Mastery',
                'position' => 'Midfield General',
                'video_id' => 'aqidX7_8Irw',
                'order' => 1,
                'is_active' => true,
            ]
        );

        // 2. Academy Feature (Video Only) - Professional training session
        ShowcaseVideo::updateOrCreate(
            ['youtube_url' => 'https://www.youtube.com/watch?v=Pb6_N-FePFM'],
            [
                'player_id' => null,
                'title' => 'Elite Academy Training Drills',
                'position' => 'Academy Showcase',
                'video_id' => 'Pb6_N-FePFM',
                'order' => 2,
                'is_active' => true,
            ]
        );
    }
}
