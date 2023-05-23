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


}