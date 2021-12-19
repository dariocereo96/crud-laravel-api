<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;
use App\Models\User;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model=Profile::class;

    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'lastname'=>$this->faker->lastname,
            'biography'=>$this->faker->sentence,
            'email'=>$this->faker->email,
            'user_id'=>User::factory(),
            'photo'=>'not_found',
        ];
    }
}
