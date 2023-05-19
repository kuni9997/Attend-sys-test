<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Attendance;

class WorkingController extends Controller
{
    public function start()
    {
        $user = [
            'user_id' => Auth::id(),
            'working_st' => Carbon::now()->toDateTime(),
        ];
        Attendance::create($user);

        session()->put('workingSes', 1);
        return redirect('/dashboard');
    }
}
