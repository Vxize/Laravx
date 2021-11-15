<?php

namespace Vxize\Lavx\Http\Controllers;

use App\Http\Controllers\Controller as AppController;

use Illuminate\Support\Str;

class Controller extends AppController
{
    public function randomString($length = 12)
    {
        return strtolower(Str::random($length));
    }
}