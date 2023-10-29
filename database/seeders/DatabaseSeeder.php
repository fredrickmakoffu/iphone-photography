<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\BadgeSeeder;
use Database\Seeders\AchievementSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BadgeSeeder::class,
            AchievementSeeder::class,
            LessonSeeder::class,
            UserSeeder::class
        ]);
    }
}
