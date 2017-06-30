@extends('layouts.main.index')


@section('content')

    {{-- START project list --}}
    <section>
        <div class="row">
            <div class="medium-12 large-12 large-centered medium-centered columns">

                @include('projects.partials.project-list')

            </div>
        </div>
    </section>
    {{-- END project list --}}

@stop