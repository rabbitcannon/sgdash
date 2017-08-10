@include('layouts.partials.ui.header')

<?php
  $path = Request::path();
  $user = \App\User::find(Auth::user()->id);
?>

<section>
    <div class="row expanded">
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


{{-- START Normal Content --}}
@if($user->role->role_id === 7)
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
            <div class="large-2 columns">
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
{{-- END Normal Content --}}

@include('layouts.partials.ui.footer')

