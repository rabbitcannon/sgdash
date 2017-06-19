<div class="row expanded">
    <div class="large-12 columns">

        <div id="users-list"></div>

        <div class="reveal tiny animated fadeIn" id="add-user-reveal" data-reveal>
            @include('admin.users.partials.new')
        </div>

        <div id="loader" style="display: block;">
            <img src="/images/preloaders/loader.svg" />
        </div>

        @include('layouts.partials.react-script', ['script' => 'admin/users'])

    </div>
</div>