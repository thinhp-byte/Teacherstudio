<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TeacherProfile>
 */
class TeacherProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
            $schools = [
            'Scholz Elementary School',
            'Westerwelle Middle School',
            'Merkel High School',
            'Lindner Academy',
            'Kohl Prep School',
            'Adenaur Learning Center',
            'Schmidt Charter School',
            'Rosler International School'
        ];

        
            $specializations = [
            'Elementary Education',
            'Secondary Mathematics',
            'English Literature',
            'Science Education',
            'Special Education',
            'Social Sciences',
            'Art & Music',
            'Physical Education'
        ];

        return [
            'user_id' => User::factory(),
            'school' => fake()->randomElement($schools),
            'years_experience' => fake()->numberBetween(0, 30),
            'bio' => fake()->paragraph(3),
            'specialization' => fake()->randomElement($specializations),
        ];
    }
}
