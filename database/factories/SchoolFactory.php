<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\School;

class SchoolFactory extends Factory
{
    protected $model = School::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {            
        return [
            'name' => $this->faker->name(),
        ];
    }
}
