<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   
    // protected $fillable = ['report_id', 'section', 'user_id','date', 'time', 'title', 'case', 'summary', 'chronology', 'measure', 'conclusion', 'qrcode', 'is_complete'];

        return [
            // id user id title body slug created at updated at
            'report_id' => Report::factory(),
            'section' => $this->faker->sentence(),
            'user_id' => User::factory(),
            'date' => $this->faker->date('l, d F Y'),
            'time' => $this->faker->time('H:i:s'),
            'title' => $this->faker->sentence(),
            'case' => $this->faker->paragraph(),
            'summary' => $this->faker->paragraph(),
            'chronology' => $this->faker->paragraph(),
            'measure' => $this->faker->paragraph(),
            'conclusion' => $this->faker->paragraph(),
            'qrcode' => 'seederqrcode.png',
            'is_complete' => array_rand([0, 1]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
