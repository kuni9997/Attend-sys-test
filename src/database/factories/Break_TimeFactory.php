<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\Break_Time;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use DateTime;

class Break_TimeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Break_Time::class;
    public function definition()
    {
        $start = Carbon::create("2023", "5", "30");
        $end = Carbon::now();

        $min = strtotime($start);
        $max = strtotime($end);

        $date = rand($min, $max);
        $date = date('Y-m-d 09:00:00', $date);
        $Time_start = new DateTime($date);
        $Time_end = new DateTime($date);

        $break_start = $Time_start->modify('+3 hour');
        $break_end = $Time_end->modify('+4 hour');
        return [
            'attendance_id' => Attendance::factory(),
            'break_time_st' => $break_start,
            'break_time_end' => $break_end,

        ];
    }
}