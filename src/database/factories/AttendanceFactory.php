<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use DateTime;

class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Attendance::class;

    public function definition()
    {
        $start = Carbon::create("2023", "5", "30");
        $end = Carbon::now();

        $min = strtotime($start);
        $max = strtotime($end);

        $date = rand($min, $max);
        $date = date('Y-m-d 09:00:00', $date);
        $work_start = new DateTime($date);
        $work_end = new DateTime($date);

        $work_end = $work_end->modify('+8 hour');

        // $break_start = $date->modify('+3 hour');
        // $break_end = $date->modify('+4 hour');

        return [
            'user_id' => user::factory(),
            'working_st'=> $work_start,
            'working_end'=> $work_end,
        ];
    }
}