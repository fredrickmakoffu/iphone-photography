<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $achievements = [
            [
                'type' => 'lesson',
                'description' => 'First Lesson Watched',
                'points' => 1,
            ],
            [
                'type' => 'lesson',
                'description' => '5 Lessons Watched',
                'points' => 5,
            ],
            [
                'type' => 'lesson',
                'description' => '10 Lessons Watched',
                'points' => 10,
            ],
            [
                'type' => 'lesson',
                'description' => '25 Lessons Watched',
                'points' => 25,
            ],
            [
                'type' => 'lesson',
                'description' => '50 Lessons Watched',
                'points' => 50,
            ],
            [
                'type' => 'comment',
                'description' => 'First Comment Written',
                'points' => 1,
            ],
            [
                'type' => 'comment',
                'description' => '3 Comments Written',
                'points' => 3,
            ],
            [
                'type' => 'comment',
                'description' => '5 Comments Written',
                'points' => 5,
            ],
            [
                'type' => 'comment',
                'description' => '10 Comments Written',
                'points' => 10,
            ],
            [
                'type' => 'comment',
                'description' => '20 Comments Written',
                'points' => 20,
            ],
        ];

        foreach ($achievements as $achievement) {
            \App\Models\Achievement::create($achievement);
        }
    }
}
