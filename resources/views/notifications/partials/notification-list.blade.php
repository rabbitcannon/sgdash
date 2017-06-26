@foreach($environments as $environment)

    @if($loop->first)
        <div class="data-card-small">
            <div class="data-header">
                <i class="fa fa-bell" aria-hidden="true"></i> Notifications
            </div>

            <div class="data-content">

                <div class="row">

                    <div class="large-12 columns">

                        <div class="data-card-small">
                            <div class="data-alt-header">

                                <?php
                                    $type = class_basename($environment->type);
                                    $formatted_type = preg_replace('/(?<!\ )[A-Z]/', ' $0', $type);
                                ?>
                                {{ $formatted_type }}

                                    <span style="font-size: .55em;">
                                        [ <a href="/notifications/{{ Auth::user()->id }}/read/env">Mark all as read</a> ]
                                    </span>
                            </div>

                        </div>
    @endif


        <div class="data-content">
            <div class="row @if($environment->read_at == null) mark-unread @else mark-read @endif">
                <div class="large-1 columns text-center" style="top: 50%;">
                    @if($environment->read_at == null)
                        <i class="fa fa-envelope fa-2x mark-unread" aria-hidden="true"></i>
                    @else
                        <i class="fa fa-envelope-open fa-2x" aria-hidden="true"></i>
                    @endif
                </div>
                <div class="large-3 columns">
                    <i class="fa fa-server fa-2x" aria-hidden="true"></i> Environment: {{ $environment->data['environment_id'] }}
                </div>
                <div class="columns">
                    @if($environment->data['current_status'] == "offline")
                        <span class="failure-text">{{ strtoupper($environment->data['current_status']) }}</span>
                    @elseif($environment->data['current_status'] == "online")
                        <span class="success-text">{{ strtoupper($environment->data['current_status']) }}</span>
                    @else
                    @endif
                </div>
            </div>

            <div>
                <hr/>
            </div>
        </div>


    @if($loop->last)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


@endforeach