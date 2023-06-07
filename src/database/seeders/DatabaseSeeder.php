<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Break_Time;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(100)
            ->has(Attendance::factory()->count(10)->has(Break_Time::factory()->count(2)))
            ->create();

        $Attendances = Attendance::all();
        foreach ($Attendances as $users) {
            $id = $users->id;
            $user_id = $users->user_id;
            $working_day = $users->working_st;
            foreach (Attendance::where('user_id', $user_id)->whereDay('working_st', $working_day)->get() as $target) {
                $target_id = $target->id;
                if ($target_id != $id) {
                    Attendance::find($target_id)->delete();
                }
            }
        }
    }
}
