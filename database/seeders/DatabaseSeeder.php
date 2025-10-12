<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TeacherProfile;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            

        $this->call([
            ResourceSeeder::class,
        ]);
    }
}
