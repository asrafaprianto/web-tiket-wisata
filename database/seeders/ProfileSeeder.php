<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProfileSeeder extends Seeder
{
    public function run()
    {
        Profile::create([
            'name' => 'Badan Usaha Milik Desa Ngudi Makmur',
            'address' => 'Desa Watukaraung, Pringkuku, Pacitan',
            'contact' => '08123456789',
            'legal_info' => 'Badan Hukum No. AHU-02100.AH.01.03.Th.2022',
            'logo' => null
        ]);
    }
}