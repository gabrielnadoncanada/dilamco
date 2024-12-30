<?php

namespace Database\Factories;

use App\Models\Collection;
use Database\Factories\Concerns\CanCreateImages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CollectionFactory extends Factory
{
    use CanCreateImages;

    public function definition(): array
    {
        return [
            Collection::TITLE => $this->faker->word,
        ];
    }
}
