@extends('layouts.main.index')


@section('content')

    {{-- START ticket open tickets list --}}
    <section>
        <div class="row">
            <div class="medium-12 large-12 large-centered medium-centered columns">

                @include('support.tickets.open')

            </div>
        </div>
    </section>
    {{-- END ticket open tickets list --}}

@stop