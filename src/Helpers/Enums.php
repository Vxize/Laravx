<?php

namespace Vxize\Lavx\Helpers;

class Enums
{
    public static function get($name)
    {
        return config('enums.'.$name, null);
    }

    public static function trans($name)
    {
        return __('enums.'.$name);
    }

    // return an array of 'value' => 'trans', for select/radio/checkbox
    public static function list($name)
    {
        $keys = self::get($name);
        if (!$keys) {
            return null;
        }
        $trans = self::trans($name);
        if (is_array($keys) && is_array($trans)) {
            return array_combine($keys, $trans);
        }
        return [$keys => $trans];
    }

    // get the translation for database value (i.e. 1,2,3 etc)
    public static function transValue($name, $value)
    {
        $list = self::list($name);
        return $list[$value] ?? '';
    }

}
