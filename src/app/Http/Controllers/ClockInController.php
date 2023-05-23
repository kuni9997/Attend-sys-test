<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Break_Time;
use DateTime;
use App\Http\Requests\AttendanceRequest;

class ClockInController extends Controller
{
    public function workingTimeSt(AttendanceRequest $request)
    {
        $user = [
            'user_id' => Auth::id(),
            'working_st' => Carbon::now(),
        ];
        Attendance::create($user);

        // session()->put('workingSes', 1);
        return redirect('/dashboard');
    }

    public function workingTimeEnd()
    {

        Attendance::getLatestId()->update(['working_end' => Carbon::now()]);
        //打刻した時に休憩終了時間が打刻されていない場合の処理
            $id = Attendance::getLatestId()->value('id');
            $data = Attendance::find($id);
                if ($data->breakTimes()->whereNull('break_time_end')->exists()) {
                    $data->breakTimes()->whereNull('break_time_end')->update(['break_time_end' => Carbon::now()]);
                }

        return redirect('/dashboard');
    }

    public function breakTimeSt()
    {

        $Time = [
            'attendance_id' => Attendance::getLatestId()->value('id'),
            'break_time_st' => Carbon::now(),
        ];
        Break_Time::create($Time);

        return redirect('/dashboard');
    }

    public function breakTimeEnd()
    {
        $id = Attendance::getLatestId()->value('id');
        $data = Attendance::find($id);
        if ($data->breakTimes()->whereNull('break_time_end')->exists()) {

            Break_Time::with([
                'attendance' => function ($query) {
                    $query->where('user_Id', Auth::id());
                }
            ])->getEndNull()->update(['break_time_end' => Carbon::now()]);

        }

        return redirect('/dashboard');
    }
}