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
        $usersWithProfiles = User::has('teacherProfile')->pluck('id');
        

        if ($usersWithProfiles->isEmpty()) {
            throw new \Exception('No users with teacher profiles found. Run DatabaseSeeder first!');
        }
    

        $userId = $usersWithProfiles->random();
        
        $collection = Collection::firstOrCreate(
            ['user_id' => $userId],
            ['name' => User::find($userId)->name . "'s Collection"]
        );
        
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
            'collection_id' => $collection->id,
            'title' => $this->faker->sentence(),
            'subject' => $this->faker->randomElement($subjects),
            'grade' => $this->faker->numberBetween(1, 12),
        ];
    }
}