<?php

namespace Database\Seeders;

use Database\Seeders\Models\CollectionSeeder;
use Database\Seeders\Models\UserSeeder;
use Illuminate\Database\Seeder;

class ModelSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CollectionSeeder::class,
        ]);
    }
}
