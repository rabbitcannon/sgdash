<?php

namespace App\Http\Controllers;

use App\Notifications;
use App\User;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Auth;
use View;

class NotificationsController extends Controller
{
    use Notifiable;

    protected $user;

    /**
     * NotificationsController constructor.
     */
    public function __construct() {
        $user = $this->user;
    }

    /**
     * @return mixed
     */
    public function index() {
        $this->user = User::find(Auth::user()->id);

        $data = [
            'environments' => Notifications::where('notifiable_id', $this->user->id)->where(function ($query) {
                $query->where('type', '=', 'App\Notifications\EnvironmentDown');
            })->get(),
        ];

        return View::make('notifications.index', $data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAllNotifications($id) {
        $this->user = User::find($id);

        return Notifications::where('notifiable_id', $this->user->id)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUnreadNotifications($id) {
        $this->user = User::find($id);

        return Notifications::where('notifiable_id', $this->user->id)->where(function ($query) {
            $query->where('read_at', '=', null);
        })->get();
    }


    /**
     * @param $id
     * @param $type
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRead($id, $type) {
        $this->user = User::find($id);

        if($type == "env") {
            $this->user->unreadNotifications()->update(['read_at' => Carbon::now()]);
        }

        return redirect('/notifications/all');
    }
}
