@extends('layouts.main.index')


@section('content')

    {{-- START new ticket form --}}
    <section>
        <div class="row">
            <div class="medium-12 large-12 large-centered medium-centered columns">

                <div id="submit-ticket">
                    @include('components.page-title', array('page_title' => 'New Ticket'))

                    <form action="">

                        <div class="row">
                            <div class="medium-8 large-offset-2 large-8 columns">
                                <label class="text-right">Subject
                                    <input type="text" placeholder="Please enter a subject">
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="medium-8 large-offset-2 large-8 columns">
                                <label class="text-right">Ticket #
                                    <input type="text" placeholder="Please enter a ticket number">
                                </label>
                            </div>
                        </div>

                        {{--<div class="row">--}}
                        {{--<div class="medium-8 large-8 medium-centered large-centered columns">--}}
                        {{--<div class="input-group">--}}
                        {{--<span class="input-group-label">#</span>--}}
                        {{--<input class="input-group-field" type="text" placeholder="Please enter a ticket number">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        <div class="row">
                            <div class="medium-8 large-offset-2 large-8 columns">
                                <label class="text-right">Project
                                    <select>
                                        <option value="Project 1">Project 1</option>
                                        <option value="Project 2">Project 2</option>
                                        <option value="Project 3">Project 3</option>
                                        <option value="Project 4">Project 4</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="medium-8 large-offset-2 large-8 columns">
                                <label class="text-right">Description
                                    <textarea name="description" rows="17"></textarea>
                                </label>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>
    {{-- END new ticket form --}}
@stop