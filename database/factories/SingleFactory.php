<?php

namespace Database\Factories;

use App\Models\Entry;
use App\Models\Single;
use Database\Factories\Concerns\CanCreateImages;
use Database\Seeders\LocalImages;
use Illuminate\Database\Eloquent\Factories\Factory;

class SingleFactory extends Factory
{
    use CanCreateImages;

    protected $model = Single::class;

    public function definition(): array
    {
        return [
            Single::TITLE => $this->faker->sentence,
            Single::DESCRIPTION => $this->faker->sentence,
            Single::IS_VISIBLE => true,
            Single::PUBLISHED_AT => now(),
        ];
    }

    public function configure(): SingleFactory
    {
        return $this->afterCreating(function (Single $single) {
            $single
                ->addMedia(LocalImages::getRandomFile())
                ->preservingOriginal()
                ->toMediaCollection(Single::MEDIA_COLLECTION);
        });
    }
}
