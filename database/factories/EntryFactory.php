<?php

namespace Database\Factories;

use App\Models\Entry;
use Database\Factories\Concerns\CanCreateImages;
use Database\Seeders\LocalImages;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntryFactory extends Factory
{
    use CanCreateImages;

    protected $model = Entry::class;

    public function definition(): array
    {
        return [
            Entry::TITLE => $this->faker->sentence,
            Entry::DESCRIPTION => $this->faker->sentence,
            Entry::PUBLISHED_AT => now(),
            Entry::IS_VISIBLE => true,
        ];
    }

    public function configure(): EntryFactory
    {
        return $this->afterCreating(function (Entry $entry) {
            $entry
                ->addMedia(LocalImages::getRandomFile())
                ->preservingOriginal()
                ->toMediaCollection(Entry::MEDIA_COLLECTION);
        });
    }
}
