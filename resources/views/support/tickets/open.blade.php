@extends('layouts.main.index')


@section('content')

    {{-- START ticket open tickets list --}}
    <section>
        <div class="row">
            <div class="medium-12 large-12 large-centered medium-centered columns">

                @include('components.page-title', ['page_title' => 'Open Tickets'])

            </div>
        </div>
    </section>
    {{-- END ticket open tickets list --}}

    {{-- START Ticket list test section --}}
    @include('support.tickets.partials.ticket-list')
{{--    @each('support.tickets.partials.ticket-list', $tickets, 'ticket', 'support.tickets.partials.ticket-list-empty')--}}
    {{-- END Ticket list test section --}}
@stop