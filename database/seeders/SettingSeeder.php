<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(['key' => 'about_us'], ['value' => 'Isi awal tentang kami di sini...']);
        Setting::updateOrCreate(['key' => 'footer_tagline'], ['value' => 'EASY TRAVEL TO FLORES']);
        Setting::updateOrCreate(['key' => 'footer_links_left'], ['value' => '<a href="#">Home</a><br><a href="#">Payment</a><br><a href="#">Order</a>']);
        Setting::updateOrCreate(['key' => 'footer_links_social'], ['value' => '<a href="#">Facebook</a><br><a href="#">Instagram</a><br><a href="#">Youtube</a>']);
        Setting::updateOrCreate(['key' => 'footer_contact'], ['value' => '<a href="mailto:example@gmail.com">example@gmail.com</a><br><span>Jln baturiti jeringo kode post 83351</span>']);
    }
}
