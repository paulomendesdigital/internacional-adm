<?php

use Illuminate\Database\Seeder;
use App\Models\Panel\Configuration;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::create([
            'phone' => '(21) 9999-9999',
            'whatsapp' => '(21) 9 9999-9999',
            'email' => 'contato@email.com',
            'facebook' => 'https://www.facebook.com/',
            'instagram' => 'https://instagram.com/',
            'youtube' => 'https://www.youtube.com',
            'twitter' => 'https://twitter.com/',
        ]);
    }
}
