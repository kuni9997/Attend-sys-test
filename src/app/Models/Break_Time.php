<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Break_Time extends Model
{
    use HasFactory;
    protected $table = 'break_times';
    protected $fillable = ['attendance_id', 'break_time_st', 'break_time_end'];
    protected $appends = ['result'];

    public function scopeGetStNull($query)
    {
        return $query->where('break_time_st', Null);
    }
    public function scopeGetEndNull($query)
    {
        return $query->where('break_time_end', Null);
    }

    public function attendance()
    {
        return $this->belongsTo('App\Models\Attendance');
    }

    public function getResultAttribute()
    {
        $keyId = $this->attendance_id;
        $times = $this->where('attendance_id', $keyId)->where('break_time_end','!=',NULL)->get();
        if ($times != NULL) {
            $value = 0;
            foreach ($times as $time) {
                $value = $value + (strtotime($time->break_time_end) - strtotime($time->break_time_st));
            }
            $break_time_sec = $value;

            $break_time_hour = floor($break_time_sec / 3600);
            $break_time_hour = ($break_time_hour == 0) ? "00" : $break_time_hour;

            $break_time_min = floor(($break_time_sec - ($break_time_hour * 3600)) / 60);
            $break_time_min = ($break_time_min == 0) ? "00" : $break_time_min;

            $break_time_s = $break_time_sec - ($break_time_hour * 3600 + $break_time_min*60);
            $break_time_s = ($break_time_s == 0) ? "00" : $break_time_s;

            $value = $break_time_hour . ":" . $break_time_min . ":" . $break_time_s ;
        } else {
            $value = "00:00:00";
        }
        // dd($value);
        return $value;
    }
}