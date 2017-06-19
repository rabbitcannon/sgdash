    <div class="text-center">
    <div id="logo-badge">
        {{--<img class="clip-avatar" src="/images/avatars/cat_face.jpg" />--}}
        <i class="fa fa-user-circle fa-5x aria-hidden="true"></i>
    </div>
    <div style="padding: 10px;">
        <small>
            <div>
                {{ $user->first_name }} {{ $user->last_name }}
            </div>
            <div>
                {{ $user->email }}
            </div>
        </small>
    </div>
</div>