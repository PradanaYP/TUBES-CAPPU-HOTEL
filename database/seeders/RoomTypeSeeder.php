<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RoomTypeSeeder extends Seeder
{
    public function run(): void
    {
        $roomTypes = [
            'standard' => [
                'overview' => 'standar_overview.jpg',
                'gallery' => ['standar_gallery1.jpg', 'standar_gallery2.jpg', 'standar_gallery3.jpg'],
            ],
            'deluxe' => [
                'overview' => 'deluxe_overview.jpg',
                'gallery' => ['deluxe_gallery1.jpg', 'deluxe_gallery2.jpg', 'deluxe_gallery3.jpg'],
            ],
            'suite' => [
                'overview' => 'suite_overview.jpg',
                'gallery' => ['suite_gallery1.jpg', 'suite_gallery2.jpg', 'suite_gallery3.jpg'],
            ],
        ];

        // Copy files to storage
        foreach ($roomTypes as $type => $images) {
            // Salin overview
            $source = public_path("images/room_types/{$images['overview']}");
            $destination = storage_path("app/public/room-types/overview/{$images['overview']}");
            if (File::exists($source)) {
                File::copy($source, $destination);
            }

            // Salin gallery
            foreach ($images['gallery'] as $image) {
                $source = public_path("images/room_types/{$image}");
                $destination = storage_path("app/public/room-types/gallery/{$image}");
                if (File::exists($source)) {
                    File::copy($source, $destination);
                }
            }
        }

        // Insert ke database (dengan path yang sesuai untuk diakses via /storage/)
        DB::table('room__types')->insert([
            [
                'type_name' => 'Standard',
                'description' => 'Spacious room with king-size bed, perfect for couples.',
                'price_per_night' => 1200000,
                'overview_image' => 'room-types/overview/standar_overview.jpg',
                'gallery_image_1' => 'room-types/gallery/standar_gallery1.jpg',
                'gallery_image_2' => 'room-types/gallery/standar_gallery2.jpg',
                'gallery_image_3' => 'room-types/gallery/standar_gallery3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Deluxe',
                'description' => 'Comfortable room with modern amenities and queen bed.',
                'price_per_night' => 950000,
                'overview_image' => 'room-types/overview/deluxe_overview.jpg',
                'gallery_image_1' => 'room-types/gallery/deluxe_gallery1.jpg',
                'gallery_image_2' => 'room-types/gallery/deluxe_gallery2.jpg',
                'gallery_image_3' => 'room-types/gallery/deluxe_gallery3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type_name' => 'Suite',
                'description' => 'Luxury suite with separate living area and premium amenities.',
                'price_per_night' => 2000000,
                'overview_image' => 'room-types/overview/suite_overview.jpg',
                'gallery_image_1' => 'room-types/gallery/suite_gallery1.jpg',
                'gallery_image_2' => 'room-types/gallery/suite_gallery2.jpg',
                'gallery_image_3' => 'room-types/gallery/suite_gallery3.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
