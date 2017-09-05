<div class="row">
    <div id="user-notifications" class="large-9 columns text-right">
        <input type="hidden" name="user_id" value="{{ $user->id }}" />
        <div class="row">
            <div class="large-2 large-offset-7 columns">
                <span class="badge green-badge" id="messageCount">1</span>
                <i class="fa fa-envelope" aria-hidden="true"></i>
                {{-- TODO: Hook up messages section --}}
            </div>

            <div class="large-2 columns">
                <div id="notifications" data-user="{{ $user->id }}"></div>
            </div>
        </div>
    </div>

    <div id="user-name-block">

        <div class="dropdown">
            <i class="fa fa-user-circle-o" aria-hidden="true"></i> Hello, {{ $user->first_name }}!
            <i class="fa fa-angle-down" aria-hidden="true"></i>

            <div class="dropdown-content">
                <ul class="menu vertical">
                    @if($user->role->id === 1)
                        <li>
                            <a href="/admin">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;Admin Panel
                            </a>
                        </li>
                    @endif
                    <li>
                        <a href="#">
                            <i class="fa fa-cogs" aria-hidden="true"></i>&nbsp;&nbsp;Settings
                        </a>
                    </li>
                    <li>
                        <a href="/auth/logout">
                            <i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</div>

