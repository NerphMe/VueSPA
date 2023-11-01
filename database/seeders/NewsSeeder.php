<?php

namespace Database\Seeders;

use App\Models\News;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 20) as $index) {
            $title = $faker->sentence(5);
            DB::table('news')->insert([
                'title' => $title,
                'url' => Str::slug($title, '-'),
                'short_description' => $faker->text(100),
                'description' => $faker->text(500),
                'status' => Arr::random(News::$newsAllowedStatuses),
                'created_at' => now(),
            ]);
        }
    }
}
