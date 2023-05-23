<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Break_Time extends Model
{
    use HasFactory;
    protected $table = 'break_times';
    protected $fillable = ['attendance_id','break_time_st', 'break_time_end'];

    public function scopeGetStNull($query)
    {
        return $query->where('break_time_st', Null);
    }
    public function scopeGetEndNull($query){
        return $query->where('break_time_end', Null);
    }

    public function attendance(){
        return $this->belongsTo('App\Models\Attendance');
    }
}