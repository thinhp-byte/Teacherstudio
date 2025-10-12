<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TeacherProfile;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Collection;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         $admin= User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);
    
            TeacherProfile::factory()->create([
                'user_id' => $admin->id,
                'school' => 'Admin School',
                'years_experience' => 10,
                'bio' => 'Experienced educator and platform administrator with a passion for sharing educational resources.',
                'specialization' => 'Educational Administration',
            ]);

        $testUser=User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
        ]);

            TeacherProfile::factory()->create([
                'user_id' => $testUser->id,
                'school' => 'Test High School',
                'years_experience' => 3,
                'bio' => 'Elementary school teacher focused on math and science education.',
                'specialization' => 'Elementary Mathematics',
            ]);

        User::factory(8)->create()->each(function ($user) {
            TeacherProfile::factory()->create([
                'user_id' => $user->id,
            ]);
        });
            
         $allUsers = User::all();
foreach ($allUsers as $user) {
    Collection::factory(rand(2, 4))->create([
        'user_id' => $user->id
    ]);
}

// Create resources and attach them to collections
$allUsers = User::all();
foreach ($allUsers as $user) {
    $userCollections = $user->collections;
    
    // Skip if user has no collections
    if ($userCollections->isEmpty()) {
        continue;
    }
    
    // Create 3-8 resources per user
    $resourceCount = rand(3, 8);
    
    for ($i = 0; $i < $resourceCount; $i++) {
        $resource = \App\Models\Resource::factory()->create();
        
        // Attach resource to 1-3 random collections owned by this user
        $collectionsToAttach = $userCollections->random(min(rand(1, 3), $userCollections->count()));
        $resource->collections()->attach($collectionsToAttach->pluck('id'));
    }
}

        // sample follows
        $allUsers = User::all();
        $admin = User::where('email', 'admin@admin.com')->first();
        $testUser = User::where('email', 'test@example.com')->first();

        // Admin follows 3 random users
        $admin->following()->attach(
            $allUsers->except([$admin->id])->random(3)->pluck('id')
        );

        // Test user follows admin and 2 others
        $testUser->follow($admin);
        $testUser->following()->attach(
            $allUsers->except([$testUser->id, $admin->id])->random(2)->pluck('id')
        );

        // Random users follow admin (make admin popular)
        $allUsers->except([$admin->id, $testUser->id])
            ->random(5)
            ->each(fn($user) => $user->follow($admin));

    }
}
