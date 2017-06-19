@foreach($user->notifications as $notification)

    {{ $notification->data['environment_id'] }}

@endforeach