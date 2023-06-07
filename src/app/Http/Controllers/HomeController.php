<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $working_st_switch = $request->working_st_switch;
        $working_end_switch = $request->working_end_switch;
        $break_time_switch = $request->break_time_switch;
        return view('dashboard', compact(
            'working_st_switch',
            'working_end_switch',
            'break_time_switch'));
    }
}
