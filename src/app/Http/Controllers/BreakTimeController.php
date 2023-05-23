<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Break_Time;
use App\Models\Attendance;


class BreakTimeController extends Controller
{
    public function start() {

        $Time = [
            'attendance_id' => Attendance::getLatestId()->value('id'),
            'break_time_st' => Carbon::now(),
        ];
        Break_Time::create($Time);
    
    return redirect('/dashboard');
    }

    public function end() {
        
        $Time=[
            'break_time_end' => Carbon::now(),
        ];

        Attendance::with('breakTimes')->getLatestId()->where('break_time_end', null)->update(['break_time_end' => $Time]);

        return redirect('/dashboard');
    }
}
