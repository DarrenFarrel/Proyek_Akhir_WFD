<?php

namespace Database\Seeders;

use App\Models\HotelInformation;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '081234567890'
        ]);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@user.com',
            'password' => Hash::make('user123'),
            'role' => 'customer',
            'phone' => '081298765432'
        ]);

        HotelInformation::create([
            'name' => 'The Westin Jakarta',
            'address' => 'Jalan HR Rasuna Said Kav C-22, Jakarta 12940, Indonesia',
            'phone' => '+62 21 2788 7788',
            'email' => 'reservation@westinjakarta.com',
            'description' => 'Located in Jakarta\'s golden triangle, The Westin Jakarta offers 300 luxurious rooms and suites with breathtaking views of the city skyline.',
            'main_image' => 'images/lobby.jpg'
        ]);

        $deluxe = RoomType::create([
            'name' => 'Deluxe Room',
            'description' => 'Spacious room with a king-size bed, work desk, and city view',
            'price_per_night' => 1500000,
            'capacity' => 2,
            'facilities' => 'King size bed, Coffee maker, Smart TV, Free WiFi, Luxury bathroom',
            'image' => 'images/deluxe.jpg'
        ]);

        $premier = RoomType::create([
            'name' => 'Premier Suite',
            'description' => 'Luxurious suite with separate living area, premium amenities, and panoramic city views.',
            'price_per_night' => 2500000,
            'capacity' => 2,
            'facilities' => 'King size bed, Living area, Mini bar, Bathrobe and slippers, Premium toiletries',
            'image' => 'images/premiere.jpg'
        ]);

        $executive = RoomType::create([
            'name' => 'Executive Lounge',
            'description' => 'Exclusive access to executive lounge with complimentary breakfast and evening cocktails.',
            'price_per_night' => 3000000,
            'capacity' => 2,
            'facilities' => 'Executive lounge access, Complimentary breakfast, Evening cocktails, Private check-in/out, Concierge service',
            'image' => 'images/executive.jpg'
        ]);

        foreach ([$deluxe, $premier, $executive] as $index => $roomType) {
            $floor = ($index + 1) * 10;
            $roomsPerType = $index === 0 ? 12 : ($index === 1 ? 8 : 5);
            
            for ($i = 1; $i <= $roomsPerType; $i++) {
                Room::create([
                    'room_type_id' => $roomType->id,
                    'room_number' => $floor * 100 + $i,
                    'floor' => $floor,
                    'status' => 'available'
                ]);
            }
        }
    }
}