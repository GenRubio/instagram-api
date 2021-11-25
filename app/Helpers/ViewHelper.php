<?php

namespace App\Helpers;

class ViewHelper
{
    public static function renderView($blade, $arg)
    {
        $data = [];
        foreach ($arg as $key => $var) {
            $data[$key] = $var;
        }
        return view($blade, $data)->render();
    }
}
