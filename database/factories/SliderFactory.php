<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SliderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->unique->words(6, true);
        $link = \Illuminate\Support\Str::slug($title);
        return [
            'title' => $title,
            'subtitle' => $this->faker->text(40),
            'link' => $link,
            'price' => $this->faker->numberBetween(10, 500),
            'image' => 'main-slider-' . $this->faker->unique->numberBetween(1, 9) . '.jpg',
//            'image' => 'digital_' .     $this->faker->unique->numberBetween(1, 22) . '.jpg',
        ];
    }
}
