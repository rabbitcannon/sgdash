<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use View;

class NotificationsController extends Controller
{
    use Notifiable;

    public function index() {
        return View::make('notifications.index');
    }
}
