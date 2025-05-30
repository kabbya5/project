<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeLog>
 */
class TimeLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-30 days', 'now');
        $end = (clone $start)->modify('+' . rand(1, 30) . ' days');
        $diffInSeconds = $end->getTimestamp() - $start->getTimestamp();
        $hours = round($diffInSeconds / 3600, 2);
        return [
            'project_id' => Project::factory(),
            'user_id' => User::factory(),
            'start_time' => $start,
            'end_time' => $end,
            'description' => $this->faker->sentence,
            'hours' => $hours,
        ];
    }
}
