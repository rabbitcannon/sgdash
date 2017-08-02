<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTicket;
use Huddle\Zendesk\Facades\Zendesk;
use Illuminate\Http\Request;
use View;

class TicketsController extends Controller
{
    //

    /**
     *
     */
    public function index() {
        $data = [
            'tickets' => Zendesk::tickets()->sideload(['users'])->findAll(),
        ];

        return View::make('tickets.index', $data);
    }


    /**
     * @param CreateTicket $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createTicket(CreateTicket $request) {
        Zendesk::tickets()->create([
            'subject' => $request->input('subject'),
            'comment' => [
                'body' => $request->input('description')
            ],
            'priority' => 'normal'
        ]);

        return redirect('/tickets');
    }

    /**
     *
     */
    public function viewTickets() {
        $tickets = Zendesk::tickets()->sideload(['users'])->findAll();
        dd($tickets);
    }

    public static function getNameIdentity($id) {
        $user = (array) Zendesk::users()->find($id);
        return $user['user']->name;
    }
}
