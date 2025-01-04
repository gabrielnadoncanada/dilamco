<?php

namespace Database\Factories;

use App\Models\Page;
use Database\Factories\Concerns\CanCreateImages;
use Database\Seeders\LocalImages;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    use CanCreateImages;

    protected $model = Page::class;

    public function definition(): array
    {
        return [
            Page::TITLE => $this->faker->sentence,
            Page::DESCRIPTION => $this->faker->sentence,
            Page::IS_VISIBLE => true,
            Page::PUBLISHED_AT => now(),
        ];
    }

    public function configure(): PageFactory
    {
        return $this->afterCreating(function (Page $single) {
            $single
                ->addMedia(LocalImages::getRandomFile())
                ->preservingOriginal()
                ->toMediaCollection(Page::MEDIA_COLLECTION);
        });
    }
}
