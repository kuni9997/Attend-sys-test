<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = ['user_id','working_st', 'working_end'];
    protected $dates = ['working_st','working_end'];

    protected $appends = ['result'];

    public function users(){
        return $this->belongsTo('App\Models\user');
    }

    public function breakTimes(){
        return $this->hasMany('App\Models\Break_Time');
    }


    public function scopeGetId($query){
        $authNum=Auth::id();
        return $query->where('user_id', $authNum);
    }

    public function scopeGetLatestId($query){
        $authNum = Auth::id();
        $dateNow = Carbon::now()->toDateString();
        return $query->where('user_id', $authNum)->whereDate('working_st', $dateNow);
    }

    public function scopeGetYesterdayId($query)
    {
        $authNum = Auth::id();
        $dateYesterday = Carbon::yesterday()->toDateString();
        return $query->where('user_id', $authNum)->whereDate('working_st', $dateYesterday);
    }

    public function getResultAttribute()
    {
        $time = $this->working_end;
        if($time != NULL){
            $value = (strtotime($time) - strtotime($this->working_st));

            $working_time_sec = $value;

            $working_time_hour = floor($working_time_sec / 3600);
            $working_time_hour = ($working_time_hour == 0) ? "00" : $working_time_hour;

            $working_time_min = floor(($working_time_sec - ($working_time_hour * 3600)) / 60);
            $working_time_min = ($working_time_min == 0) ? "00" : $working_time_min;

            $working_time_s = $working_time_sec - ($working_time_hour * 3600 + $working_time_min*60);
            $working_time_s = ($working_time_s == 0) ? "00" : $working_time_s;

            $value = $working_time_hour . ":" . $working_time_min . ":" . $working_time_s ;

        }else{
            $value = "00:00:00";
        }

        return $value;
    }


}