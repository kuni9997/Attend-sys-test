<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use DateTime;

class RecordController extends Controller
{
    public function recordIndex(Request $request)
    {
        $date = ($request->input('date')==NULL) ? Carbon::now()->format('Y-m-d'):$request->input('date');

        $users = User::with([
            'Attendances' => function ($query) use($date) {
                $query->whereDate('working_st', $date);
            },
            'Attendances.breakTimes' => function ($query) {
                $query->get();
            }
        ])->whereHas('Attendances' ,function ($query) use($date) {
                $query->whereDate('working_st', $date);
            })->paginate(5);
        $date1 = new DateTime($date);
        $date2 = new DateTime($date);
        $date3 = new DateTime($date);

        return view('AttendanceList',compact('users','date1', 'date2', 'date3'));
    }
}