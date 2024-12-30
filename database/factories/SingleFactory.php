<?php

namespace Database\Factories;

use App\Models\Single;
use Database\Factories\Concerns\CanCreateImages;
use Illuminate\Database\Eloquent\Factories\Factory;

class SingleFactory extends Factory
{
    use CanCreateImages;

    protected $model = Single::class;

    public function definition(): array
    {
        return [
            Single::TITLE => $this->faker->sentence,
            Single::SLUG => $this->faker->unique()->slug,
            Single::DESCRIPTION => $this->faker->sentence,
            Single::IS_VISIBLE => true,
            Single::PUBLISHED_AT => now(),
            Single::IMAGE => $this->createImage(),
            Single::CREATED_AT => now(),
            Single::UPDATED_AT => now(),
        ];
    }
}
