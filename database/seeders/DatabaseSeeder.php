<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        // $this->call(TransaksiSeeder::class);
        $this->call(ProfileSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ProdukSeeder::class);

    }
}