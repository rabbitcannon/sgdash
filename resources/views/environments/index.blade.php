@extends('layouts.main.index')


@section('content')

    <section>
        <div class="row">
            <div class="medium-12 large-12 large-centered medium-centered columns">

                @include('environments.panels.servers')

            </div>
        </div>
    </section>



@stop