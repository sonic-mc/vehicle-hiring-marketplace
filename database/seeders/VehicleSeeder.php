<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;
use App\Models\User;

class VehicleSeeder extends Seeder
{
    public function run(): void
    {
        // Create or fetch a dummy user to own the vehicles
        $user = User::firstOrCreate(
            ['email' => 'owner@example.com'],
            [
                'name' => 'Test Owner',
                'password' => bcrypt('password') // You can log in with this if needed
            ]
        );

        $vehicles = [
            [
                'title' => 'Toyota Hiace for Church Trip',
                'description' => 'Comfortable 14-seater ideal for group travel.',
                'location' => 'Harare',
                'price' => 120,
                'capacity' => 14,
                'purpose' => 'church',
                'images' => [
                    'https://th.bing.com/th/id/OIP.aG0h_7mEBbQT_QIJrgWfSgHaFl?r=0&rs=1&pid=ImgDetMain&cb=idpwebpc1'
                ],
            ],
            [
                'title' => 'Luxury Mercedes for Weddings',
                'description' => 'Elegant black Mercedes Benz for VIP events.',
                'location' => 'Bulawayo',
                'price' => 250,
                'capacity' => 5,
                'purpose' => 'wedding',
                'images' => [
                    'https://th.bing.com/th/id/OIP.K6ecP9WaffU76gV2Ik2vbgHaFd?r=0&rs=1&pid=ImgDetMain&cb=idpwebpc1'
                ],
            ],
            [
                'title' => 'Family Minivan for Trips',
                'description' => 'Spacious and fuel-efficient minivan for family getaways.',
                'location' => 'Mutare',
                'price' => 100,
                'capacity' => 7,
                'purpose' => 'trip',
                'images' => [
                    'https://th.bing.com/th/id/R.4f4c7926417136903d32920e147602e2?rik=cF3LlAOUbnckWQ&pid=ImgRaw&r=0'
                ],
            ],
            [
                'title' => 'Tour Bus for Large Groups',
                'description' => '40-seater tour bus with air conditioning.',
                'location' => 'Victoria Falls',
                'price' => 500,
                'capacity' => 40,
                'purpose' => 'tour',
                'images' => [
                    'https://th.bing.com/th/id/R.fb0dfa8d13e4a81af4cbfd0eab3118c7?rik=YKJimY6YRNVN%2fQ&pid=ImgRaw&r=0'
                ],
            ],
            [
                'title' => 'Funeral Hearse Vehicle',
                'description' => 'Well-maintained hearse for dignified funerals.',
                'location' => 'Gweru',
                'price' => 180,
                'capacity' => 4,
                'purpose' => 'funeral',
                'images' => [
                    'https://th.bing.com/th/id/OIP.Mfhhf2WUxndApQB31F_2ggHaE8?r=0&rs=1&pid=ImgDetMain&cb=idpwebpc1'
                ],
            ],
        ];

        foreach ($vehicles as $data) {
            Vehicle::create([
                ...$data,
                'images' => json_encode($data['images']),
                'user_id' => $user->id, // Attach to dummy user
            ]);
        }
    }
}
