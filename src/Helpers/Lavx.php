<?php

namespace Vxize\Lavx\Helpers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class Lavx
{
    public static function randomString($length = 12)
    {
        return strtolower(Str::random($length));
    }

    // convert utc time to another timezone
    // default is convert current time to user's timezone
    public static function toTimeZone($time = null, $time_zone = null)
    {
        $utc_time = $time ? Carbon::parse($time, 'UTC') : now();
        return $utc_time->tz($time_zone ?? auth()->user()->time_zone ?? 'UTC');
    }

    // convert another timezone to utc time
    // default is convert current time in user's timezone to utc
    public static function fromTimeZone($time = null, $time_zone = null)
    {
        $from_time = $time
            ? Carbon::parse($time, $time_zone ?? auth()->user()->time_zone)
            : now($time_zone ?? auth()->user()->time_zone ?? 'UTC');
        return $from_time->tz('UTC');
    }

}
