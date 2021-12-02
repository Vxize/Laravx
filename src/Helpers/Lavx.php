<?php

namespace Vxize\Lavx\Helpers;

class Lavx
{
    public static function randomString($length = 12)
    {
        return strtolower(\Str::random($length));
    }

    public static function inUserTime($time = null)
    {
        $utc_time = $time ? \Carbon::parse($time) : now();
        return $utc_time->tz(\Auth::user()->time_zone);
    }

}
