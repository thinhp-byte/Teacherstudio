<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Collection;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
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
        'title' => $this->faker->sentence(),
        'subject' => $this->faker->randomElement($subjects),
        'grade' => $this->faker->numberBetween(1, 12),
    ];
}
}