<div class="row">
    <div id="user-notifications" class="large-9 columns">

        <div class="row">
            <div class="large-3 large-offset-6 columns">
                <div class="n-option">
                    <i class="fa fa-envelope" aria-hidden="true"></i>
                    <span class="badge green-badge" id="messageCount">1</span>
                    <span class="n-option-label">Messages</span>
                </div>
            </div>

            <div class="large-3 columns">
                <div id="notifications" class="n-option">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    <span class="badge red-badge" id="messageCount">
                        {{ count($user->unreadNotifications) }}
                    </span>
                    <span class="n-option-label">Notifications</span>

                    <!-- START Notifications -->
                    <div class="notifications__items">
                        <div class="dialogue-arrow"></div>
                        <div class="data-card-flyout">
                            <div class="data-header">
                                Notifications
                            </div>
                            <div class="data-content">
                                @foreach ($user->unreadNotifications as $notification)
                                    @include('layouts.partials.notifications.' . snake_case(class_basename($notification->type)))
                                @endforeach
                            </div>
                            <a href="/notifications/all">
                                <div class="data-footer">
                                    All Notifications
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- END Notifications -->

                </div>
            </div>
        </div>
    </div>

    <div class="large-3 columns">
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
</div>

