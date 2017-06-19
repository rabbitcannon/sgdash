<?php

namespace App\Http\Controllers;

use App\Notifications\EnvironmentDown;
use App\User;
use Illuminate\Support\Facades\Notification;

class EnvironmentsController extends Controller
{
    public function environmentDown() {
        $users = User::all();

        $environment = [
            'id' => 12345,
            'status' => 'offline'
        ];

        Notification::send($users, new EnvironmentDown($environment));
    }
}
