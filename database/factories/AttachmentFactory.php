<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'post_id' => Post::factory(),
            'image_name' => $this->faker->title(),
            'path' => $this->faker->imageUrl(),
        ];
    }
}
