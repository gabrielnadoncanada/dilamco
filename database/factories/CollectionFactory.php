<?php

namespace Database\Factories;

use App\Enums\PermalinkType;
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
            Collection::TITLE => $title = $this->faker->word,
            Collection::PERMALINK_TYPE => PermalinkType::KEY,
            Collection::SLUG => Str::slug($title),
            Collection::CREATED_AT => now(),
            Collection::UPDATED_AT => now(),
        ];
    }
}
