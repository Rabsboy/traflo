<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TravelPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('travel_packages')->insert([
            [
                'name' => 'Flores Island Discovery',
                'duration' => '4 days 3 nights',
                'location' => 'Flores Island, Indonesia',
                'description' => 'A 4 days 3 nights journey through the beautiful Flores Island, exploring local villages, natural wonders, and the stunning Komodo National Park.',
                'price' => 3000000,  // Harga dalam Rupiah
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kelimutu Lake Sunrise Tour',
                'duration' => '3 days 2 nights',
                'location' => 'Kelimutu, Flores, Indonesia',
                'description' => 'Visit the famous Kelimutu volcano and its three colored lakes in this 3 days 2 nights adventure, including local cultural tours and breathtaking sunrises.',
                'price' => 2500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Komodo Island & Flores Adventure',
                'duration' => '5 days 4 nights',
                'location' => 'Komodo Island, Flores, Indonesia',
                'description' => 'Explore the incredible wildlife of Komodo Island and the pristine beaches of Flores over 5 days 4 nights, with opportunities for diving and trekking.',
                'price' => 4500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Labuan Bajo Eco-tour',
                'duration' => '3 days 2 nights',
                'location' => 'Labuan Bajo, Indonesia',
                'description' => 'Enjoy a sustainable 3 days 2 nights eco-tour in Labuan Bajo, known for its marine life, waterfalls, and the famous Komodo dragons.',
                'price' => 2000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Flores Cultural and Nature Escape',
                'duration' => '6 days 5 nights',
                'location' => 'Flores Island, Indonesia',
                'description' => 'A relaxing 6 days 5 nights tour to experience the vibrant culture of Flores, with visits to local villages, beautiful beaches, and natural wonders.',
                'price' => 5000000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Flores Island Trekking and Diving Expedition',
                'duration' => '7 days 6 nights',
                'location' => 'Flores Island, Indonesia',
                'description' => 'A thrilling 7 days 6 nights adventure to explore the hidden trekking trails and dive sites around Flores Island and the surrounding archipelago.',
                'price' => 6500000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
