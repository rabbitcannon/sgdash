<div class="row expanded">
    <div class="large-12 columns">
        <div class="data-card-small">
            <div class="data-header">
                <div class="row expanded">
                    <div class="large-10 columns">
                        <i class="fa fa-ticket" aria-hidden="true"></i>Open Tickets
                    </div>
                    <div class="large-2 columns text-right">
                        <a class="no-smoothState" data-toggle="add-ticket-reveal">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add
                        </a>
                    </div>
                </div>

            </div>
            <div class="data-content">

                <?php $max = $tickets->count; $ticket = $tickets->tickets; $user = $tickets->users; ?>

                    @for($i = 0; $i < $max; $i++)
                        <div class="data-card-small">
                            <div class="data-alt-header">
                                <div class="row expanded">
                                <div class="large-6 columns text-left">
                                    {{ $ticket[$i]->subject }} <span class="date"> by: {{ \App\Http\Controllers\TicketsController::getNameIdentity($ticket[$i]->requester_id) }}</span></div>
                                <div class="large-6 columns text-right">
                                    <span class="date">
                                        Submitted on: {{ $ticket[$i]->created_at }}
                                    </span>
                                </div>
                                </div>
                            </div>

                            <div class="data-content text-left">

                                <div class="row">

                                    <div class="large-12 columns">
                                        <p>
                                            {{ str_replace(" ", "\n", $tickets->tickets[$i]->description) }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endfor

            </div>
        </div>
    </div>
</div>

{{--@include('layouts.partials.page-script', ['script' => 'tickets'])--}}
