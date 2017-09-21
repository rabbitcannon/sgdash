<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\URL;

class SettingsController extends Controller
{
    /**
     * @return mixed
     */
    public static function title() {
        $root = url('/');
        $current = URL::current();
        $parse = str_replace($root . "/", "", $current);
        if($parse != $current) {
            $title = ucwords($parse);
        }
        else {
            $title = "Home";
        }

        return str_replace("/", " >> ", $title);
    }
}
