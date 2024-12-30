<?php

namespace Database\Seeders\Models;

use App\Models\Collection;
use App\Models\Entry;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CollectionSeeder extends Seeder
{
    public function run()
    {
        $types = ['job', 'project', 'service', 'team', 'article'];

        foreach ($types as $type) {
            $collection = Collection::factory()->create([
                Collection::TITLE => ucfirst(Str::plural($type)),
            ]);

            Entry::factory()
                ->count(5)
                ->for($collection)
                ->create();
        }
    }
}
