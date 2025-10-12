<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class CollectionFactory extends Factory
{
    public function definition(): array
    {
        $subjects = [
            'Mathematics',
            'English', 
            'Science',
            'History',
            'Art',
            'Music',
            'PE',
            'Geography',
            'Spanish',
            'Computer Science'
        ];
        
        return [
            'user_id' => User::factory(),
            'name' => fake()->words(3, true) . ' Collection',
            'subject' => fake()->randomElement($subjects),
        ];
    }
}