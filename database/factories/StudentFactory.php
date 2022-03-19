<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\School;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'      => $this->faker->name(),
            'school_id' => function() { return School::get()->random()->id; },
            'order'     => rand(1, 2),
        ];
    }
}
