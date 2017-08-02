@extends('layouts.main.index')


@section('content')

    <section>
        @include('tickets.partials.ticket-list')

        <div class="reveal small animated fadeIn" id="add-ticket-reveal" data-reveal>
            @include('tickets.partials.new')
        </div>
    </section>

@stop