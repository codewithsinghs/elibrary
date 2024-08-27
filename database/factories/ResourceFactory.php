<?php

namespace Database\Factories;

use App\Models\Resource;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
    /*
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Resource::class;

    public function definition(): array
    {
        $name = $this->faker->name(4); // Generate a fake name
        $slug = Str::slug($name); // Generate a slug from the name

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->paragraph(4),
            'url' => $this->faker->url,
            'caption' => $this->faker->sentence,
            'category' => $this->faker->word(),
            'author' => $this->faker->name(),
            'published_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'image' => $this->faker->imageUrl(640, 480, 'courses', true),
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
