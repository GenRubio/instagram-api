<?php

namespace App\Helpers;

use App\Models\MenuItem;
use App\Models\Rrss;

class MenuHelper
{
    public static function getMenuTop()
    {
        return MenuItem::whereNull('parent_id')->menuTop()->with('children')->ordered()->active()->get();
    }

    public static function getMenuFooter()
    {
        return MenuItem::whereNull('parent_id')->menuFooter()->with('children')->ordered()->active()->get();
    }

    public static function getRrss()
    {
        return Rrss::active()->ordered()->get();
    }
}
