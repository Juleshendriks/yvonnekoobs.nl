<?php

namespace Database\Seeders;

use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Sophie', 'Daan', 'Emma', 'Lucas', 'Julia', 'Milan', 'Lotte', 'Timo', 'Eva', 'Noah'];
        $companies = ['TechCo', 'Designify', 'WebBoost', 'CoachPro', 'GreenBiz'];
        $positions = ['CEO', 'Manager', 'Consultant', 'Developer', 'Coach'];

        foreach (range(1, 15) as $i) {
            Review::create([
                'name' => $names[array_rand($names)],
                'company' => $companies[array_rand($companies)],
                'position' => $positions[array_rand($positions)],
                'review' => 'Geweldige ervaring! Zeer professioneel en behulpzaam.',
                'rating' => rand(4, 5),
                'avatar' => 'https://i.pravatar.cc/150?img=' . rand(1, 70),
                'is_featured' => 0,
                'is_active' => true,
                'sort_order' => $i,
            ]);
        }
    }
}
