<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
         $user = User::has('teacherProfile')->inRandomOrder()->first();
        

        $collection = Collection::firstOrCreate(
            [
                'user_id' => $user->id,
                'name' => $user->name . "'s Collection"
            ]
        );

        $subjects = ['Mathematics', 'English', 'Science', 'History', 'Art', 'Music', 'PE', 'Geography'];
        return [
            'title' => $this->faker->sentence(),
            'subject' => $this->faker->word(),
            'grade' => $this->faker->numberBetween(1, 12),
            'collection_id' => \App\Models\Collection::factory(),
        ];
    }
}
