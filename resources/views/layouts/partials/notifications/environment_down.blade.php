<div class="row" style="padding: 5px 0;">
    <div class="large-10 columns text-left">
        Environment: {{ $notification->data['environment_id'] }} {{ $notification->data['current_status'] }}
    </div>
    <div class="columns text-right">
        <span class="mark-read">
            <i class="fa fa-envelope" aria-hidden="true"></i>
        </span>
    </div>
</div>
