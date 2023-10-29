<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $badges = [
            [
                'description' => 'Beginner',
                'points' => 0,
            ],
            [
                'description' => 'Intermediate',
                'points' => 4,
            ],
            [
                'description' => 'Advanced',
                'points' => 8,
            ],
            [
                'description' => 'Master',
                'points' => 10,
            ],
            [
                'description' => 'King',
                'points' => 20,
            ],
        ];

        foreach ($badges as $badge) {
            \App\Models\Badge::create($badge);
        }
    }
}
