<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        $start_date = fake()->date("Y-m-d", now("America/Bogota"));
        return [
            "name" => fake()->name(),
            "startDate" => $start_date,
            "endDate" => Carbon::parse($start_date)->addMonths(1)->subDays(1),
        ];
    }
}
