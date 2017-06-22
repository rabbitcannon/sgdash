<?php

namespace App\Http\Controllers;

use App\Notifications;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Auth;
use View;

class NotificationsController extends Controller
{
    use Notifiable;

    /**
     * @return mixed
     */
    public function index() {
        return View::make('notifications.index');
    }

    public function getNotifications($id) {
//        $id = Auth::user()->name;
        return Notifications::where('notifiable_id', $id)->get();
    }
}
