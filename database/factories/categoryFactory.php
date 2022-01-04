<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class categoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category_name = $this->faker->unique->words(2, true);
        $slug = Str::slug($category_name);
        return [
            'name'=>$category_name,
            'slug'=>$slug,
        ];
    }
}
