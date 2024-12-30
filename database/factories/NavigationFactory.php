<?php

namespace Database\Factories;

use App\Models\Navigation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class NavigationFactory extends Factory
{
    protected $model = Navigation::class;

    public function definition()
    {
        $title = preg_replace('/\./', '', $this->faker->sentence(3));

        return [
            Navigation::TITLE => $title,
            Navigation::HANDLE => Str::slug($title),
        ];
    }
}
