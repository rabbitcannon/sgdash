@include('layouts.partials.ui.header')

<?php
  $path = Request::path();
  $user = \App\User::find(Auth::user()->id);
?>

{{-- START Header Content --}}
<section>
    <div class="row expanded collapse">
        <div class="large-12 columns user-login-bar">
            <div class="row expanded">

                <div class="large-6 columns">
                    &nbsp;<span id="admin-header-text">
                        <a href="/">
                            SciPlay
                        </a>
                    </span>
                </div>

                <div class="large-6 columns text-right">
                    @include('layouts.partials.ui.user-panel')
                </div>

            </div>
        </div>

    </div>
</section>
{{-- END Header Content --}}


{{-- START Body Content --}}
<?php $executive = \App\Role::where('name', 'Executive')->first(); ?>
@if($user->role->role_id === $executive->id)
    <section>
        <div class="row">
            <div class="large-12 columns">

                <div class="m-scene pad-box" id="main">
                    <div class="m-header scene_element scene_element--fadein">
                        <div id="content-container">
                            <div>
                                @include('projects.partials.exec-project-list')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@else
    <section>
        <div class="row expanded">
            <div class="large-2 columns menu-background">
                @include('layouts.partials.ui.side-menu', ['position' => $path])
            </div>
            <div class="large-10 columns">

                <div class="m-scene pad-box" id="main">
                    <div class="m-header scene_element scene_element--fadein">
                        <div id="content-container">
                            <div>
                                @include('layouts.partials.ui.breadcrumb', ['position' => $path])
                            </div>
                            @yield('content')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endif
{{-- END Body Content --}}

{{-- START Footer Content --}}
<section>
    <div class="row expanded">
        <div class="large-2 columns menu-background"></div>
        <div class="large-10 columns">
            @include('layouts.partials.ui.footer')
        </div>
    </div>
</section>
{{-- END Footer Content --}}