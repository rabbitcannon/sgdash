@foreach($user->notifications as $notification)

    @if($loop->first)
        <div class="data-card-small">
            <div class="data-header">
                <i class="fa fa-bell" aria-hidden="true"></i> Notifications
            </div>
    @endif

            <div class="data-content">

                <div class="row">

                    <div class="large-6 columns">

                        <div class="data-card-small">
                            <div class="data-alt-header text-center">
                                <?php
                                    $type = class_basename($notification->type);
                                    $formatted_type = preg_replace('/(?<!\ )[A-Z]/', ' $0', $type);
                                ?>
                                {{ $formatted_type }}
                            </div>

                            <div class="data-content text-center">
                                Environment: {{ $notification->data['environment_id'] }} - {{ strtoupper($notification->data['current_status']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    @if($loop->last)
        </div>
    @endif


@endforeach