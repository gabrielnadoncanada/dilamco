<?php

namespace Database\Factories;

use App\Models\Entry;
use Database\Factories\Concerns\CanCreateImages;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntryFactory extends Factory
{
    use CanCreateImages;

    protected $model = Entry::class;

    public function definition(): array
    {
        return [
            Entry::TITLE => $this->faker->sentence,
            Entry::SLUG => $this->faker->unique()->slug,
            Entry::DESCRIPTION => $this->faker->sentence,
            Entry::PUBLISHED_AT => now(),
            Entry::IS_VISIBLE => true,
            Entry::IMAGE => $this->createImage(),
            Entry::CREATED_AT => now(),
            Entry::UPDATED_AT => now(),
        ];
    }
}
