<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceSwitch
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //勤怠時間はデータがあれば値を渡す
        //勤怠開始が打刻されていない時->今日の日付のレコードがない->終了できない
        //勤務開始が打刻されている時->今日の日付のレコードがある->開始できない
        //休憩時間が開始されている->開始できない
        //休憩時間が開始されていない->終了できない
        $data = Attendance::with([
            'breakTimes' => function ($query) {
                $query->whereDate('break_time_st', Carbon::now());
            }
        ])->where('user_id', Auth::id())->whereDate('working_st',Carbon::now())->first();
        if ($data != null) {
            //1=>操作可能,2=>操作不可
            if (isset($data)) {
                //勤務開始が打刻されている時->開始できない
                $working_st_switch = 2;

                if (isset($data->working_end)) {
                    //勤務終了済
                    $working_end_switch = 2;
                } else {
                    //勤務終了していない
                    $working_end_switch = 1;
                }
            } else {
                //勤怠開始が打刻されていない時->開始できる
                $working_st_switch = 1;
                //勤務終了できない
                $working_end_switch = 2;
            }
            if ($data->breakTimes->isEmpty()) {
                $break_time_switch = 1;
                //反対->休憩開始は可,休憩終了は不可=>1

            } else {
                foreach ($data->breakTimes as $breakTime) {
                    if (isset($breakTime->break_time_end)) {
                        $break_time_switch = 1;
                    } else {
                        $break_time_switch = 2;
                    }
                }
                //休憩時間が開始されている->休憩開始は不可,休憩終了は可=>2
            }
        }else{
            $working_st_switch = 1;
            $working_end_switch =2;
            $break_time_switch = 1;
        }
        // dd($data->breakTimes->break_time_end);
        $request->merge(
            compact(
                'working_st_switch',
                'working_end_switch',
                'break_time_switch'
            )
        );
        return $next($request);
    }
}