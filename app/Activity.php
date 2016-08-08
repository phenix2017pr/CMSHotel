<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //
    protected $table = 'activities';

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class,
            'activity_reservation',
            'activity_id',
            'reservation_id')->withPivot('time');
    }

    public function getFormattedDuration()
    {
        $time = explode(':', $this->duration);

        $a = Carbon::createFromTime($time[0], $time[1], $time[2]);
        //return $a->toTimeString();
        $str = '';
        if($time[0] != 0)
            $str .= $time[0] . ' hour/s ';
        elseif($time[1] != 0)
            $str .= $time[1] . ' minute/s';
        return $str;
    }
}
