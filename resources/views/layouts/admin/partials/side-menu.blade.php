<div class="row">
    <div id="avatar-holder" class="large-12 columns">
        @include('layouts.partials.ui.logo')
    </div>
</div>

<div class="row">
    <div id="admin-menu" class="large-12 columns menu-holder">
        <div class="menu-item">
            <a href="/admin/projects">
                @if($position === 'projects')
                    <span class="active-item">
                        <i class="fa fa-bar-chart"></i> Projects
                    </span>
                @else
                    <i class="fa fa-bar-chart"></i> Projects
                @endif
            </a>
        </div>

        {{--<div class="menu-item">--}}
            {{--<a href="/admin/promotions">--}}
                {{--@if($position === 'promotions')--}}
                    {{--<span class="active-item">--}}
                        {{--<i class="fa fa-usd"></i> Promotions--}}
                    {{--</span>--}}
                {{--@else--}}
                    {{--<i class="fa fa-usd"></i> Promotions--}}
                {{--@endif--}}
            {{--</a>--}}
        {{--</div>--}}

        {{--<div class="menu-item">--}}
            {{--<a href="/admin/environments">--}}
                {{--@if($position === 'environments')--}}
                    {{--<span class="active-item">--}}
                        {{--<i class="fa fa-database"></i> Environments--}}
                    {{--</span>--}}
                {{--@else--}}
                    {{--<i class="fa fa-database"></i> Environments--}}
                {{--@endif--}}
            {{--</a>--}}
        {{--</div>--}}

        <div class="menu-item">
            <a href="/admin/support">
                @if($position === 'support')
                    <span class="active-item">
                        <i class="fa fa-support"></i> Support
                    </span>
                @else
                    <i class="fa fa-support"></i> Support
                @endif
            </a>
        </div>

        <div class="menu-item">
            <a href="/admin/users">
                @if($position === 'users')
                    <span class="active-item">
                        <i class="fa fa-users"></i> Users
                    </span>
                @else
                    <i class="fa fa-users"></i> Users
                @endif
            </a>
        </div>
    </div>
</div>
