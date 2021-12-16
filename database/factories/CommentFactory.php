<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;
use App\Models\User;
use App\Models\Article;


class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     *
     * @return array
     */
    protected $model=Comment::class;

    public function definition()
    {
        return [
            'body'=>$this->faker->paragraph(),
            'user_id' => User::factory(),
            'article_id'=>Article::factory(),
        ];
    }
}
