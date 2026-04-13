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

        // 1. Linked Highlight (Hybrid)
        ShowcaseVideo::updateOrCreate(
            ['youtube_url' => 'https://www.youtube.com/watch?v=8_8Xm_idOfE'],
            [
                'player_id' => $player?->id,
                'title' => 'Demo Student - Midfield Maestro',
                'position' => 'Center Midfielder',
                'video_id' => '8_8Xm_idOfE',
                'order' => 1,
                'is_active' => true,
            ]
        );

        // 2. Academy Feature (Video Only)
        ShowcaseVideo::updateOrCreate(
            ['youtube_url' => 'https://www.youtube.com/watch?v=In_SAm8X8Nc'],
            [
                'player_id' => null,
                'title' => 'TRFA Elite Training Session',
                'position' => 'Academy Feature',
                'video_id' => 'In_SAm8X8Nc',
                'order' => 2,
                'is_active' => true,
            ]
        );
    }
}
