<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;
use App\Models\User;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model=Article::class;

    public function definition()
    {
        return [
            'title'=>$this->faker->sentence(),
            'body'=>$this->faker->paragraph(),
            'user_id' => User::factory(),
        ];
    }
}
