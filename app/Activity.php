<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Activity
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reservation[] $reservations
 * @mixin \Eloquent
 */
class Activity extends Model
{
    //
    use SoftDeletes;

    protected $table = 'activities';
    protected $dates = ['deleted_at'];

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class,
            'activity_reservation',
            'activity_id',
            'reservation_id')
            ->withPivot('id', 'time')
            ->withTimestamps();
    }

    public function getTotalActivityIncome()
    {
        $income = 0;
        foreach ($this->reservations()->get() as $reservation){
            $income += $this->price;
        }

        return $income;
    }


    public function getFormattedDuration()
    {
        $time = explode(':', $this->duration);

        $a = Carbon::createFromTime($time[0], $time[1], $time[2]);
        //return $a->toTimeString();
        $str = '';
        if($time[0] != 0){
            $plural =  ($time[0] > 1) ? 'hours' : 'hour';
            $str .= $time[0]  . ' ' . $plural . ' ';
        }
        elseif($time[1] != 0){
            $plural =  ($time[1] > 1) ? 'minutes' : 'minute';
            $str .= $time[1] . ' ' . $plural;
        }
        return $str;
    }
}
