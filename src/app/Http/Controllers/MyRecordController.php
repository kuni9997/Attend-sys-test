<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;


class MyRecordController extends Controller
{
    public function recordIndex(Request $request)
    {

        // dd($request->date);

        $date = ($request->input('date') == NULL) ? Carbon::now()->format('Y-m-d') : $request->input('date');

        // dd($date);
        $users = User::with([
            'Attendances' => function ($query) use ($date) {
                $query->where('user_id', Auth::id())->whereDate('working_st', $date);
            },
            'Attendances.breakTimes' => function ($query) {
                $query->get();
            }
        ])->whereHas('Attendances', function ($query) use ($date) {
            $query->whereDate('working_st', $date);
        })->get();
        // dd($users);
        $date1 = new DateTime($date);
        $date2 = new DateTime($date);
        $date3 = new DateTime($date);

        return view('MyAttendanceList', compact('users', 'date1', 'date2', 'date3'));
    }
}