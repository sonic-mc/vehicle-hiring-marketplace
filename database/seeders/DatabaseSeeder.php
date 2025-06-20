<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test Owner',
            'email' => 'owner@example.com',
            'password' => bcrypt('password'), // default password
        ]);
    
        $this->callWith(VehicleSeeder::class, ['user' => $user]);
    }
        
    
}
