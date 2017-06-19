<nav aria-label="You are here:" role="navigation">
    <ul class="breadcrumbs">
        <li>
            <a href="/admin">
                <i class="fa fa-home" aria-hidden="true"></i> Admin Dashboard
            </a>
        </li>
        @if($position !== 'admin')
            <li>
                /<span class="show-for-sr">Current: </span> {{ $position }}
            </li>
        @endif
    </ul>
</nav>