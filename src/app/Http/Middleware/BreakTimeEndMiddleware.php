<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Attendance;
use App\Models\Break_Time;


class BreakTimeEndMiddleware
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
        if (Attendance::getLatestId()->doesntExist()) {
            //前日の勤怠終了時間を打刻
            Attendance::getYesterdayId()->update(['working_end' => Carbon::yesterday()->format('Y-m-d 00:00:00')]);

            //日付を跨いだ後の勤怠テーブルを作成
            $user = [
                'user_id' => Auth::id(),
                'working_st' => Carbon::now()->format('Y-m-d 00:00:00'),
            ];
            Attendance::create($user);


            //日を跨いだ時に休憩終了時間が打刻されていない場合の処理
            $id = Attendance::getYesterdayId()->value('id');
            $data = Attendance::find($id);
            if ($data->breakTimes()->whereNull('break_time_end')->exists()) {
                $data->breakTimes()->whereNull('break_time_end')->update(['break_time_end' => Carbon::yesterday()->format('Y-m-d 00:00:00')]);

                $Time = [
                    'attendance_id' => Attendance::getLatestId()->value('id'),
                    'break_time_st' => Carbon::now()->format('Y-m-d 00:00:00'),
                    'break_time_end' => Carbon::now(),
                ];
                Break_Time::create($Time);
            }



        }
        return $next($request);
    }
}
