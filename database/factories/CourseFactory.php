<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Course::class;

    public function definition(): array
    {
        $name = $this->faker->name(4); // Generate a fake name
        $slug = Str::slug($name); // Generate a slug from the name
        return [

            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->paragraph(4),
            'duration' => $this->faker->numberBetween(1, 100), // Adjust the range as needed
            'category' => $this->faker->word(),
            'level' => $this->faker->randomElement(['Beginner', 'Intermediate', 'Advanced']),
            'instructor' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 10, 1000), // Adjust the range as needed
            'start_date' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'end_date' => $this->faker->dateTimeBetween('now', '+2 years'),
            'image' => $this->faker->imageUrl(640, 480, 'courses', true) // Adjust image size and category as needed
        ];
    }
}
