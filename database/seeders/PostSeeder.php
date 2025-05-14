<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [
            [
                'title' => 'Menikmati Keindahan Danau Kelimutu',
                'slug' => Str::slug('Menikmati Keindahan Danau Kelimutu'),
                'excerpt' => 'Danau Kelimutu dengan tiga warna yang memukau.',
                'content' => '<p>Danau Kelimutu merupakan salah satu keajaiban alam Indonesia dengan tiga warna yang unik: merah, biru, dan putih. Terletak di Pulau Flores, danau ini menawarkan pemandangan yang luar biasa saat matahari terbit.</p>',
                'image' => 'kelimutu.jpg',
            ],
            [
                'title' => 'Labuan Bajo: Gerbang Wisata Flores',
                'slug' => Str::slug('Labuan Bajo: Gerbang Wisata Flores'),
                'excerpt' => 'Labuan Bajo adalah pintu masuk menuju Taman Nasional Komodo.',
                'content' => '<p>Labuan Bajo terkenal dengan pelabuhan yang indah dan akses menuju Pulau Komodo. Selain itu, sunset di Bukit Cinta adalah pemandangan yang tidak boleh dilewatkan.</p>',
                'image' => 'labuan_bajo.jpg',
            ],
            [
                'title' => 'Mengenal Budaya Flores yang Unik',
                'slug' => Str::slug('Mengenal Budaya Flores yang Unik'),
                'excerpt' => 'Budaya Flores penuh dengan kekayaan adat dan tradisi.',
                'content' => '<p>Di Flores, budaya adat masih dijaga dengan baik. Tarian Caci dari Manggarai dan upacara Penti adalah contoh tradisi yang masih dipertahankan hingga kini.</p>',
                'image' => 'budaya_flores.jpg',
            ],
            [
                'title' => 'Eksplorasi Laut Flores yang Mempesona',
                'slug' => Str::slug('Eksplorasi Laut Flores yang Mempesona'),
                'excerpt' => 'Laut Flores memiliki keindahan bawah laut yang eksotis.',
                'content' => '<p>Diving di perairan Flores memberikan pengalaman luar biasa dengan terumbu karang yang masih alami dan berbagai spesies laut langka, seperti manta ray dan hiu karang.</p>',
                'image' => 'laut_flores.jpg',
            ],
            [
                'title' => 'Jelajah Pulau-Pulau Eksotis di Flores',
                'slug' => Str::slug('Jelajah Pulau-Pulau Eksotis di Flores'),
                'excerpt' => 'Pulau-pulau kecil di sekitar Flores menyimpan keindahan yang luar biasa.',
                'content' => '<p>Pulau Padar, Pulau Rinca, dan Pulau Komodo adalah destinasi favorit wisatawan dengan pemandangan bukit hijau dan pantai pasir putih yang memesona.</p>',
                'image' => 'pulau_flores.jpg',
            ],
        ];

        foreach ($posts as $post) {
            Post::create($post);
        }

        echo "Post seeder berhasil ditambahkan!\n";
    }
}
